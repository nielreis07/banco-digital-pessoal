<?php

namespace App\Http\DTO\Conta;

class ContaTransferenciaDto
{
    public function __construct(
        public readonly ?int $idContaOrdenador,
        public readonly ?int $idContaBeneficiario,
        public readonly ?string $tipo,
        public readonly ?string $numero,
        public readonly ?string $agencia,
        public readonly ?float $valor,
    ) {}

    public function toArray(): array
    {
        return [
            'id_conta_ordenador' => $this->idContaOrdenador,
            'id_conta_beneficiario' => $this->idContaBeneficiario,
            'valor' => $this->valor,
        ];
    }
}
