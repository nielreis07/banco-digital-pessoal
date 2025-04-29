<?php

namespace App\Http\UseCases\Conta;

use App\Http\DTO\Conta\ContaTransferenciaDto;
use App\Http\Repositories\Conta\Interface\ContaRepositoryInterface;
use App\Http\Repositories\Extrato\Interface\ExtratoRepositoryInterface;
use App\Http\UseCases\BaseUseCase;
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

            $contaOrdenador = $this->contaRepository->buscarContaPorIdPessoa($input->idContaOrdenador);
            ContaException::validarRegrasPersistencia($contaOrdenador, $input->valor);
            $contaOrdenador = $this->contaRepository->sacarValor($input->idContaOrdenador, $input->valor);

            $contaBeneficiario = $this->contaRepository->buscarContaPorIdPessoa($input->idContaBeneficiario);
            ContaException::validarContaExiste($contaBeneficiario);
            $contaBeneficiario = $this->contaRepository->depositarValor($input->idContaBeneficiario, $input->valor);

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
