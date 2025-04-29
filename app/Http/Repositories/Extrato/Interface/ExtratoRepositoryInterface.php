<?php

namespace App\Http\Repositories\Extrato\Interface;

interface ExtratoRepositoryInterface
{
    public function registrarExtrato(array $dados): void;
}
