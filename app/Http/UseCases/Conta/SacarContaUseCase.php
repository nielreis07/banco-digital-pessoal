<?php

namespace App\Http\UseCases\Conta;

use App\Http\DTO\Conta\ContaDto;
use App\Http\Repositories\Conta\Interface\ContaRepositoryInterface;
use App\Http\Repositories\Extrato\Interface\ExtratoRepositoryInterface;
use App\Http\UseCases\BaseUseCase;
use App\Models\Extrato;
use Illuminate\Support\Facades\DB;

class SacarContaUseCase extends BaseUseCase
{
    public function __construct(
        private ContaRepositoryInterface $contaRepository,
        private ExtratoRepositoryInterface $extratoRepository,
    ) {}

    public function execute($input): array
    {
        if (! $input instanceof ContaDto) {
            throw new \InvalidArgumentException('O input deve ser uma instância de ContaDto.');
        }

        try {
            DB::beginTransaction();

            $conta = $this->contaRepository->sacarValor($input->id, $input->saldo);

            $this->extratoRepository->registrarExtrato([
                'pessoa_id' => $conta['pessoa_id'],
                'conta_id' => $input->id,
                'operacao' => Extrato::OPERACAO_SAQUE,
                'valor' => $conta['saldo'],
            ]);

            DB::commit();

            return $conta;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception('Erro ao realizar saque: '.$e->getMessage());
        }
    }
}
