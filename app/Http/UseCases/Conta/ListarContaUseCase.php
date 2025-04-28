<?php

namespace App\Http\UseCases\Conta;

use App\Http\Repositories\Conta\Interface\ContaRepositoryInterface;
use App\Http\Services\DataTablesService;
use App\Http\UseCases\BaseUseCase;

class ListarContaUseCase extends BaseUseCase
{
    public function __construct(
        private ContaRepositoryInterface $contaRepository
    ) {}

    public function execute($input = null): array
    {
        $contas = $this->contaRepository->listarContas();

        $dataTablesService = new DataTablesService();
        $dataTables = [];
        foreach ($contas as $conta) {

            $actions = $dataTablesService->btnEdit('conta.editar', ['id' => $conta['id'], 'pessoa_id' => $conta['pessoa_id']])
                .$dataTablesService->btnDelete('conta.deletar', ['id' => $conta['id']])
                .$dataTablesService->btnDetails('conta.exibir', ['id' => $conta['id'], 'pessoa_id' => $conta['pessoa_id']]);

            $dataTables[] = [
                $conta['numero'],
                $conta['pessoa']['nome'],
                $conta['tipo_descricao'],
                '<nobr>'.$actions.'</nobr>',
            ];
        }

        $dataTablesService->heads([
            'Nº Conta',
            'Titular',
            'Tipo',
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
