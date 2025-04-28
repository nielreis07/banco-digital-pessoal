<?php

namespace App\Http\UseCases\Pessoa;

use App\Http\DTO\Pessoa\PessoaDto;
use App\Http\Repositories\Pessoa\Interface\PessoaRepositoryInterface;
use App\Http\UseCases\BaseUseCase;

class SalvarPessoaUseCase extends BaseUseCase
{
    public function __construct(
        private PessoaRepositoryInterface $pessoaRepository
    ) {}

    public function execute($input): array
    {
        if (! $input instanceof PessoaDto) {
            throw new \InvalidArgumentException('O input deve ser uma instância de PessoaDto.');
        }

        $usuario = $this->pessoaRepository->vinculado($input->usuario_id, $input?->id);
        if (! empty($usuario)) {
            throw new \InvalidArgumentException('Usuário já está vínculado.');
        }

        if (! empty($input->id)) {
            $pessoa = $this->pessoaRepository->atualizarPessoa($input->id, $input->toArray());

            return $pessoa;
        }

        $pessoa = $this->pessoaRepository->criarPessoa($input->toArray());

        return $pessoa;
    }
}
