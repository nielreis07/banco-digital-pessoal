<?php

namespace App\Http\UseCases\Conta;

use App\Http\Repositories\Conta\Interface\ContaRepositoryInterface;
use App\Http\UseCases\BaseUseCase;

class ExcluirContaUseCase extends BaseUseCase
{
    public function __construct(
        private ContaRepositoryInterface $contaRepository
    ) {}

    public function execute($id): array
    {
        $this->contaRepository->deletarConta($id);

        return [];
    }
}
