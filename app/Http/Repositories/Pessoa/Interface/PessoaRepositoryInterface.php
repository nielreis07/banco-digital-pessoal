<?php

namespace App\Http\Repositories\Pessoa\Interface;

interface PessoaRepositoryInterface
{
    public function listarPessoas(array $where = []): array;

    public function buscarPessoaPorId($id): array;

    public function vinculado(int $usuarioId, ?int $pessoaId): ?object;

    public function criarPessoa(array $dados): array;

    public function atualizarPessoa($id, array $dados): array;

    public function deletarPessoa($id): void;
}
