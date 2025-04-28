<?php

namespace App\Http\UseCases\Conta;

use App\Http\DTO\Conta\ContaDto;
use App\Http\Repositories\Conta\Interface\ContaRepositoryInterface;
use App\Http\UseCases\BaseUseCase;

class SalvarContaUseCase extends BaseUseCase
{
    public function __construct(
        private ContaRepositoryInterface $contaRepository
    ) {}

    public function execute($input): array
    {
        if (! $input instanceof ContaDto) {
            throw new \InvalidArgumentException('O input deve ser uma instância de ContaDto.');
        }

        if (! empty($input->id)) {
            $pessoa = $this->contaRepository->atualizarConta($input->id, $input->toArray());

            return $pessoa;
        }

        $conta = $this->contaRepository->criarConta($input->toArray());

        return $conta;
    }
}
