<?php

namespace App\Http\Controllers;

use App\Http\DTO\Pessoa\PessoaDto;
use App\Http\UseCases\Pessoa\ConsultarPessoaUseCase;
use App\Http\UseCases\Pessoa\ExcluirPessoaUseCase;
use App\Http\UseCases\Pessoa\ListarPessoaUseCase;
use App\Http\UseCases\Pessoa\SalvarPessoaUseCase;
use App\Traits\ResponseViewTrait;
use Illuminate\Http\Request;

class PessoaController extends Controller
{
    use ResponseViewTrait;

    public function __construct(
        private SalvarPessoaUseCase $salvarPessoaUseCase,
        private ListarPessoaUseCase $listarPessoaUseCase,
        private ConsultarPessoaUseCase $consultarPessoaUseCase,
        private ExcluirPessoaUseCase $excluirPessoaUseCase,
    ) {}

    public function listar()
    {
        $pessoas = $this->listarPessoaUseCase->execute(null);

        return view('modules.pessoa.index', $this->success(
            $pessoas,
            'Pessoas retornadas com sucesso!',
            200,
        ));
    }

    public function formulario($id = null)
    {
        ['pessoa' => $pessoa, 'usuarios' => $usuarios] = $this->consultarPessoaUseCase->execute($id);

        return view('modules.pessoa.form', $this->success(
            compact('pessoa', 'usuarios'),
            '',
            200,
        ));
    }

    public function deletar($id)
    {
        $this->excluirPessoaUseCase->execute($id);

        return redirect()->route('pessoa.listar')->with('success', 'Pessoa excluída com sucesso!');
    }

    public function salvar(Request $request)
    {
        try {

            $pessoa = $this->salvarPessoaUseCase->execute(
                new PessoaDto(
                    $request->get('id'),
                    $request->get('nome'),
                    $request->get('cpf'),
                    $request->get('data_nascimento'),
                    $request->get('telefone'),
                    $request->get('bairro'),
                    $request->get('cidade'),
                    $request->get('estado'),
                    $request->get('complemento'),
                    $request->get('cep'),
                    $request->get('perfil'),
                    $request->get('usuario_id', null),
                )
            );

            return redirect()->route('pessoa.editar', ['id' => $pessoa['id']])->with('success', 'Pessoa editada com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }

    public function exibir($id)
    {
        ['pessoa' => $pessoa] = $this->consultarPessoaUseCase->execute($id);

        return view('modules.pessoa.details', $this->success(
            compact('pessoa'),
            '',
            200,
        ));
    }
}
