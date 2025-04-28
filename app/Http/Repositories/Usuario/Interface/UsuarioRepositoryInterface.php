<?php

namespace App\Http\Repositories\Usuario\Interface;

interface UsuarioRepositoryInterface
{
    public function listarUsuarios(): array;

    public function buscarUsuarioPorId($id): array;

    public function buscarUsuarioJaVinculado($id): ?object;

    public function listaSuspensa(): array;
}
