<?php

namespace App\Http\UseCases\Pessoa;

use App\Http\Repositories\Pessoa\Interface\PessoaRepositoryInterface;
use App\Http\Services\DataTablesService;
use App\Http\UseCases\BaseUseCase;

class ListarPessoaUseCase extends BaseUseCase
{
    public function __construct(
        private PessoaRepositoryInterface $pessoaRepository
    ) {}

    public function execute($input = null): array
    {
        $pessoas = $this->pessoaRepository->listarPessoas();

        $dataTablesService = new DataTablesService();
        $dataTables = [];
        foreach ($pessoas as $pessoa) {

            $actions = $dataTablesService->btnEdit('pessoa.editar', ['id' => $pessoa['id']])
                .$dataTablesService->btnDelete('pessoa.deletar', ['id' => $pessoa['id']])
                .$dataTablesService->btnDetails('pessoa.exibir', ['id' => $pessoa['id']])
                .$dataTablesService->btnAdd('conta.cadastrar', ['id' => 0, 'pessoa_id' => $pessoa['id']], 'Conta');

            $dataTables[] = [
                $pessoa['nome'],
                $pessoa['cpf'],
                $pessoa['usuario']['name'],
                '<nobr>'.$actions.'</nobr>',
            ];
        }

        $dataTablesService->heads([
            'Nome',
            'CPF',
            'Usuário',
            'Ações',
        ]);
        $dataTablesService->data($dataTables);
        $dataTablesService->order([[1, 'asc']]);
        $dataTablesService->columns([
            null,
            null,
            null,
            ['orderable' => false],
        ]);

        return $dataTablesService->config();
    }
}
