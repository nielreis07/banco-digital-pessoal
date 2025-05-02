<?php

namespace App\Http\Repositories\Pessoa;

use App\Http\Repositories\Exceptions\PessoaException;
use App\Http\Repositories\Pessoa\Interface\PessoaRepositoryInterface;
use App\Models\Pessoa;

class PessoaRepository implements PessoaRepositoryInterface
{
    public function listarPessoas(array $where = []): array
    {
        $query = Pessoa::with('usuario', 'conta');
        if (!empty($where)) {
            $query->where(function ($query) use ($where) {
                foreach ($where as $condition) {

                    if (count($condition) === 3) {
                        $query->orWhere($condition[0], $condition[1], $condition[2]);
                    }
                }
            });
        }

        $pessoas = $query->get();
        if (empty($pessoas)) {
            return [];
        }

        return $pessoas->toArray();
    }

    public function buscarPessoaPorId($id): array
    {
        return Pessoa::find($id)->toArray();
    }

    public function vinculado($usuarioId, $pessoaId): ?object
    {
        $query = Pessoa::where('usuario_id', $usuarioId);
        if (! empty($pessoaId)) {
            $query->where('id', '!=', $pessoaId);
        }
        $pessoa = $query->first();

        return $pessoa;
    }

    public function criarPessoa(array $dados): array
    {

        PessoaException::validarRegrasPersistencia($dados);

        $dados['cpf'] = preg_replace('/\D/', '', $dados['cpf']);
        $dados['data_nascimento'] = \Carbon\Carbon::createFromFormat('d/m/Y H:i', $dados['data_nascimento'])->format('Y-m-d');
        $dados['telefone'] = preg_replace('/\D/', '', $dados['telefone']);
        $dados['cep'] = preg_replace('/\D/', '', $dados['cep']);
        $dados['estado'] = preg_replace('/[^A-Z]/', '', $dados['estado']);

        $pessoa = Pessoa::create($dados);

        return $pessoa->toArray();
    }

    public function atualizarPessoa($id, array $dados): array
    {
        $pessoa = Pessoa::find($id);
        $pessoa->update($dados);

        return $pessoa->toArray();
    }

    public function deletarPessoa($id): void
    {
        $pessoa = Pessoa::find($id);
        $pessoa->delete();
    }
}
