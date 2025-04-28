<?php

namespace App\Http\Repositories\Exceptions;

class ContaException extends \Exception
{
    public static function validarRegrasPersistencia(array $dados, float $valor)
    {
        self::validarContaExiste($dados);
        self::validarSaldoInsuficiente($valor, $dados['saldo']);
    }

    public static function validarContaExiste(mixed $conta)
    {
        if (empty($conta)) {
            throw new \Exception('Conta não encontrado.');
        }
    }

    public static function validarSaldoInsuficiente(float $valor, float $saldo)
    {
        if (empty($saldo) || $saldo < $valor || $saldo == 0) {
            throw new \Exception('saldo insuficiente.');
        }
    }

    public static function validarContasDiferentes(int $idContaOrdenador, int $idContaBeneficiario)
    {
        if ($idContaOrdenador === $idContaBeneficiario) {
            throw new \Exception('As contas devem ser diferentes.');
        }
    }
}
