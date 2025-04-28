<?php

namespace App\Http\UseCases\Pessoa;

use App\Http\Repositories\Pessoa\Interface\PessoaRepositoryInterface;
use App\Http\UseCases\BaseUseCase;

class ExcluirPessoaUseCase extends BaseUseCase
{
    public function __construct(
        private PessoaRepositoryInterface $pessoaRepository
    ) {}

    public function execute($id): array
    {
        $this->pessoaRepository->deletarPessoa($id);

        return [];
    }
}
