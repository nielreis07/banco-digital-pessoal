<?php

namespace App\Http\UseCases\Conta;

use App\Http\Repositories\Conta\Interface\ContaRepositoryInterface;
use App\Http\Repositories\Pessoa\Interface\PessoaRepositoryInterface;
use App\Http\UseCases\BaseUseCase;

class ConsultarContaUseCase extends BaseUseCase
{
    public function __construct(
        private ContaRepositoryInterface $contaRepository,
        private PessoaRepositoryInterface $pessoaRepository,
    ) {}

    public function execute($id): array|object|null
    {
        if (!empty($id)) {

            $pessoas = $this->pessoaRepository->listarPessoas(
                [['id', '<>', $id]]
            );
            $conta = $this->contaRepository->buscarContaPorIdPessoa($id);

            return [
                'pessoas' => $pessoas,
                'conta' => $conta,
            ];
        }

        $contas = $this->contaRepository->listarContas();

        if (empty($contas)) {
            return null;
        }

        return $contas;
    }
}
