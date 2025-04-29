<?php

namespace App\Http\Repositories\Extrato;

use App\Http\Repositories\Extrato\Interface\ExtratoRepositoryInterface;
use App\Models\Extrato;

class ExtratoRepository implements ExtratoRepositoryInterface
{
    public function registrarExtrato(array $dados): void
    {
        Extrato::create($dados);
    }
}
