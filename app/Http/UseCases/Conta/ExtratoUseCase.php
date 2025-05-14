<?php 

namespace App\Http\UseCases\Conta;

use App\Http\Repositories\Extrato\Interface\ExtratoRepositoryInterface;
use App\Http\UseCases\BaseUseCase;

class ExtratoUseCase extends BaseUseCase
{
    public function __construct(
        private ExtratoRepositoryInterface $extratoRepository,
    ) {
    }

    public function execute($idConta): array|object|null
    {
        //buscar estrato por id da conta
        $extrato = $this->extratoRepository->buscarExtratoPorIdConta($idConta);
        if (empty($extrato)) {
            throw new \Exception('Extrato não encontrado', 404);
        }

        $extrato = array_map(function ($item) {
            return [
                'id' => $item['id'],
                'operacao' => $item['operacao'],
                'valor' => $item['valor'],
            ];
        }, $extrato);

        return ['heads' => [
            'id',
            'operacao',
            'valor',
        ],'extrato' => $extrato];

    }
}