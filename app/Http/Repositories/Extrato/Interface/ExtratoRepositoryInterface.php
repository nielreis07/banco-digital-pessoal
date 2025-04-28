<?php

namespace App\Http\Repositories\Conta\Interface;

interface ExtratoRepositoryInterface
{
    public function registrarExtrato(array $dados): void;
}
