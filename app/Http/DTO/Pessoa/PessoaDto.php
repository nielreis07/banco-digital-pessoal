<?php

namespace App\Http\DTO\Pessoa;

class PessoaDto
{
    public function __construct(
        public readonly ?int $id,
        public readonly string $nome,
        public readonly string $cpf,
        public readonly string $data_nascimento,
        public readonly string $telefone,
        public readonly string $bairro,
        public readonly string $cidade,
        public readonly string $estado,
        public readonly string $complemento,
        public readonly string $cep,
        public readonly string $perfil,
        public readonly ?int $usuario_id = null,
    ) {}

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'cpf' => $this->cpf,
            'data_nascimento' => $this->data_nascimento,
            'telefone' => $this->telefone,
            'bairro' => $this->bairro,
            'cidade' => $this->cidade,
            'estado' => $this->estado,
            'complemento' => $this->complemento,
            'cep' => $this->cep,
            'perfil' => $this->perfil,
            'usuario_id' => $this->usuario_id,
        ];
    }
}
