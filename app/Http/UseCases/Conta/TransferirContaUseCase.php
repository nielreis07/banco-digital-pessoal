<?php

namespace App\Http\UseCases\Conta;

use App\Http\DTO\Conta\ContaTransferenciaDto;
use App\Http\Repositories\Conta\Interface\ContaRepositoryInterface;
use App\Http\Repositories\Extrato\Interface\ExtratoRepositoryInterface;
use App\Http\UseCases\BaseUseCase;
use App\Models\Extrato;
use Illuminate\Support\Facades\DB;
use App\Http\Repositories\Exceptions\ContaException;

class TransferirContaUseCase extends BaseUseCase
{
    public function __construct(
        private ContaRepositoryInterface $contaRepository,
        private ExtratoRepositoryInterface $extratoRepository,
    ) {}

    public function execute($input): array
    {
        if (! $input instanceof ContaTransferenciaDto) {
            throw new \InvalidArgumentException('O input deve ser uma instância de ContaDto.');
        }

        ContaException::validarContasDiferentes($input->idContaOrdenador, $input->idContaBeneficiario);
        try {
            DB::beginTransaction();

            $contaOrdenador = $this->contaRepository->buscarConta($input->idContaOrdenador);
            ContaException::validarRegrasPersistencia($contaOrdenador, $input->valor);
            $contaOrdenador = $this->contaRepository->sacarValor($input->idContaOrdenador, $input->valor);
            
            $this->extratoRepository->registrarExtrato([
                'pessoa_id' => $contaOrdenador['pessoa']['id'],
                'conta_id' => $contaOrdenador['id'],
                'operacao' => Extrato::OPERACAO_SAQUE,
                'valor' => $contaOrdenador['saldo'],
            ]);

            $contaBeneficiario = $this->contaRepository->buscarConta(
                $input->idContaBeneficiario,
                ['tipo' => $input->tipo, 'numero' => $input->numero, 'agencia' => $input->agencia]
            );
            ContaException::validarContaExiste($contaBeneficiario);
            $contaBeneficiario = $this->contaRepository->depositarValor($input->idContaBeneficiario, $input->valor);
            $this->extratoRepository->registrarExtrato([
                'pessoa_id' => $contaBeneficiario['pessoa']['id'],
                'conta_id' => $contaBeneficiario['id'],
                'operacao' => Extrato::OPERACAO_DEPOSITO,
                'valor' => $contaBeneficiario['saldo'],
            ]);

            DB::commit();

            return [
                'ordenador' => $contaOrdenador,
                'beneficiatio' => $contaBeneficiario,
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception('Erro ao realizar transferência: ' . $e->getMessage());
        }
    }
}
