<?php

namespace App\Http\Repositories\Conta;

use App\Http\Repositories\Conta\Interface\ContaRepositoryInterface;use App\Models\Conta;

class ContaRepository implements ContaRepositoryInterface
{
    public function listarContas(): array
    {
        return Conta::with('pessoa')->get()->toArray();
    }

    public function buscarContaPorIdPessoa($id): array
    {
        $conta = Conta::with('pessoa')->where('pessoa_id', $id)->first();

        return $conta?->toArray() ?? [];
    }

    public function buscarConta($id, $where = []): array
    {
        $conta = Conta::with('pessoa')->where('id', $id);

        if (is_array($where) && count($where) > 0) {
            foreach ($where as $key => $value) {
                $conta->where($key, $value);
            }
        };

        return $conta?->first()?->toArray() ?? [];
    }

    public function criarConta(array $dados): array
    {
        $conta = Conta::create($dados);

        return $conta->toArray();
    }

    public function atualizarConta($id, array $dados): array
    {
        $conta = Conta::find($id);
        if (! $conta) {
            return [];
        }
        $conta->update($dados);

        return $conta->toArray();
    }

    public function deletarConta($id): void
    {
        $conta = Conta::find($id);
        if ($conta) {
            $conta->delete();
        }
    }

    public function sacarValor($id, float $valor): array
    {
        $conta = Conta::find($id);
        if (! $conta) {
            return [];
        }
        $conta->saldo -= $valor;
        $conta->save();

        return $conta->toArray();
    }

    public function depositarValor($id, float $valor): array
    {
        $conta = Conta::find($id);
        if (! $conta) {
            return [];
        }
        $conta->saldo += $valor;
        $conta->save();

        return $conta->toArray();
    }

}
