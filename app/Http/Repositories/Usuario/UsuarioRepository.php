<?php

namespace App\Http\Repositories\Usuario;

use App\Http\Repositories\Usuario\Interface\UsuarioRepositoryInterface;
use App\Models\User;

class UsuarioRepository implements UsuarioRepositoryInterface
{
    public function listarUsuarios(): array
    {
        $usuario = User::all();

        return $usuario->toArray();
    }

    public function buscarUsuarioPorId($id): array
    {
        $usuario = User::find($id);

        return $usuario->toArray();
    }

    public function buscarUsuarioJaVinculado($id): ?object
    {
        $usuario = User::doesntHave('pessoa')->where('id', $id)->first();

        return $usuario;
    }

    public function listaSuspensa(): array
    {
        $usuario = User::pluck('name', 'id');

        return $usuario->toArray();
    }
}
