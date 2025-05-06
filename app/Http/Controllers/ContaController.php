<?php

namespace App\Http\Controllers;

use App\Http\DTO\Conta\ContaDto;
use App\Http\DTO\Conta\ContaTransferenciaDto;
use App\Http\Requests\OperacaoBancariaRequest;
use App\Http\UseCases\Conta\ConsultarContaUseCase;
use App\Http\UseCases\Conta\DepositarContaUseCase;
use App\Http\UseCases\Conta\ExcluirContaUseCase;
use App\Http\UseCases\Conta\ListarContaUseCase;
use App\Http\UseCases\Conta\SacarContaUseCase;
use App\Http\UseCases\Conta\SalvarContaUseCase;
use App\Http\UseCases\Conta\TransferirContaUseCase;
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
        private SacarContaUseCase $sacarContaUseCase,
        private DepositarContaUseCase $depositarContaUseCase,
        private TransferirContaUseCase $transferirContaUseCase,
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

    public function operacaoBancaria(OperacaoBancariaRequest $request)
    {
        try{
            $operacao = $request->input('operacao');

            $dto = new ContaDto(
                id: $request->input('idContaOrdenador'),
                tipo: $request->input('tipo'),
                numero: $request->input('numero'),
                agencia: $request->input('agencia'),
                pessoaId: $request->input('idPessoa'),
                saldo: $request->input('valor'),
            );
            
            if ($operacao == "saque") {
               $this->sacarContaUseCase->execute($dto);
            }

            if ($operacao == "deposito") {
                $this->depositarContaUseCase->execute($dto);
            }

            if ($operacao == "transferencia") {
                $dto = new ContaTransferenciaDto(
                    idContaOrdenador: $request->input('idContaOrdenador'),
                    idContaBeneficiario: $request->input('idContaBeneficiario'),
                    tipo: $request->input('tipo'),
                    numero: $request->input('numero'),
                    agencia: $request->input('agencia'),
                    valor: $request->input('valor'),
                );
                    
                $this->transferirContaUseCase->execute($dto);
            }

            return redirect()->route('conta.exibir', ['id' => $request->input('idContaOrdenador'), 'pessoa_id' => $request->input('idPessoa')])
                ->with('success', 'Operação realizada com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

}
