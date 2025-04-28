<?php

namespace App\Http\Controllers;

use App\Http\DTO\Conta\ContaDto;
use App\Http\UseCases\Conta\ConsultarContaUseCase;
use App\Http\UseCases\Conta\ExcluirContaUseCase;
use App\Http\UseCases\Conta\ListarContaUseCase;
use App\Http\UseCases\Conta\SalvarContaUseCase;
use App\Traits\ResponseViewTrait;
use Illuminate\Http\Request;

class ContaController extends Controller
{
    use ResponseViewTrait;

    public function __construct(
        private SalvarContaUseCase $salvarContaUseCase,
        private ConsultarContaUseCase $consultarContaUseCase,
        private ExcluirContaUseCase $excluirContaUseCase,
        private ListarContaUseCase $listarUseCase,
    ) {}

    public function listar()
    {
        $pessoas = $this->listarUseCase->execute(null);

        return view('modules.pessoa.index', $this->success(
            $pessoas,
            'Pessoas retornadas com sucesso!',
            200,
        ));
    }

    public function formulario($id = null, $pessoaId = null)
    {
        $conta = ! empty($pessoaId) ? $this->consultarContaUseCase->execute($pessoaId) : [];

        return view('modules.conta.form', $this->success(
            compact('conta', 'id', 'pessoaId'),
            '',
            200,
        ));
    }

    public function deletar($id)
    {
        $this->excluirContaUseCase->execute($id);

        return redirect()->route('conta.listar')->with('success', 'Conta excluída com sucesso!');
    }

    public function salvar(Request $request)
    {
        try {
            $contaDto = new ContaDto(
                id: $request->input('id'),
                tipo: $request->input('tipo'),
                numero: $request->input('numero'),
                pessoaId: $request->input('pessoa_id'),
                agencia: $request->input('agencia'),
                codigoVerificador: $request->input('codigo_verificador'),
            );

            $this->salvarContaUseCase->execute($contaDto);

            return redirect()->route('conta.listar')->with('success', 'Conta salva com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function exibir($id, $pessoaId)
    {
        ['conta' => $conta, 'pessoas' => $pessoas] = $this->consultarContaUseCase->execute($pessoaId);

        return view('modules.conta.details', $this->success(
            compact('conta', 'pessoas'),
            '',
            200,
        ));
    }
}
