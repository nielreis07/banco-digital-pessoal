<?php

namespace App\Http\DTO\Conta;

class ContaTransferenciaDto
{
    public function __construct(
        public readonly ?int $idContaOrdenador,
        public readonly ?int $idContaBeneficiario,
        public readonly ?float $valor = null,
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
