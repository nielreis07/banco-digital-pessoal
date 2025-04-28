<?php

namespace App\Http\UseCases\Pessoa;

use App\Http\Repositories\Pessoa\Interface\PessoaRepositoryInterface;
use App\Http\Repositories\Usuario\Interface\UsuarioRepositoryInterface;
use App\Http\UseCases\BaseUseCase;

class ConsultarPessoaUseCase extends BaseUseCase
{
    public function __construct(
        private PessoaRepositoryInterface $pessoaRepository,
        private UsuarioRepositoryInterface $usuarioRepository
    ) {}

    public function execute($id): array
    {
        $pessoa = null;
        if (! empty($id)) {
            $pessoa = $this->pessoaRepository->buscarPessoaPorId($id);
        }

        $usuarios = $this->usuarioRepository->listaSuspensa();

        return [
            'pessoa' => $pessoa,
            'usuarios' => $usuarios,
        ];
    }
}
