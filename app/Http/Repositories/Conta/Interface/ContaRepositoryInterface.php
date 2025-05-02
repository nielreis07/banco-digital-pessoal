<?php

namespace App\Http\Repositories\Conta\Interface;

interface ContaRepositoryInterface
{
    public function listarContas(): array;
    public function buscarConta(int $id, array $where = []): array;
    public function buscarContaPorIdPessoa($id): array;

    public function criarConta(array $dados): array;

    public function atualizarConta($id, array $dados): array;

    public function deletarConta($id): void;

    public function sacarValor($id, float $valor): array;

    public function depositarValor($id, float $valor): array;
}
