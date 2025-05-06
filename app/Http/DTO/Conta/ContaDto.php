<?php

namespace App\Http\DTO\Conta;

class ContaDto
{
    public function __construct(
        public readonly ?int $id,
        public readonly ?string $tipo,
        public readonly ?string $numero,
        public readonly ?int $pessoaId,
        public readonly ?string $agencia,
        public readonly ?float $saldo = 0.0,
    ) {}

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'tipo' => $this->tipo,
            'numero' => $this->numero,
            'pessoa_id' => $this->pessoaId,
            'agencia' => $this->agencia,
            'saldo' => $this->saldo,
        ];
    }
}
