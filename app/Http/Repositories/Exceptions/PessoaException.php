<?php

namespace App\Http\Repositories\Exceptions;

class PessoaException extends \Exception
{
    public static function validarRegrasPersistencia(array $dados)
    {
        $dados['cpf'] = preg_replace('/\D/', '', $dados['cpf']);
        static::validarCpf($dados['cpf']);

        $dados['data_nascimento'] = \Carbon\Carbon::createFromFormat('d/m/Y H:i', $dados['data_nascimento'])->format('Y-m-d');
        static::validarDataNascimento($dados['data_nascimento']);

        $dados['telefone'] = preg_replace('/\D/', '', $dados['telefone']);
        static::validaTelefone($dados['telefone']);

        $dados['cep'] = preg_replace('/\D/', '', $dados['cep']);
        static::validaCep($dados['cep']);

        static::validaBairro($dados['bairro']);

        static::validaCidade($dados['cidade']);

        $dados['estado'] = preg_replace('/[^A-Z]/', '', $dados['estado']);
        static::validaEstado($dados['estado']);

        static::validaPerfil($dados['perfil']);
    }

    public static function validarCpf($cpf)
    {
        if (empty($cpf)) {
            throw new self('O CPF não pode ser vazio.');
        }

        // verifica se o CPF tem 11 dígitos
        if (strlen($cpf) != 11) {
            throw new self('O CPF deve conter 11 dígitos.');
        }

        if (preg_match('/^(\d)\1{10}$/', $cpf)) {
            throw new self('O CPF não pode ser um número repetido.');
        }

        $cpfExistente = \App\Models\Pessoa::where('cpf', $cpf)->first();
        if ($cpfExistente) {
            throw new self('O CPF já está cadastrado.');
        }
    }

    public static function validarDataNascimento(string $data)
    {
        if (! preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $data)) {
            throw new \Exception('Data inválida. Use o formato d/m/Y.');
        }

        $idade = \Carbon\Carbon::parse($data)->age;

        if ($idade < 18) {
            throw new \Exception('Menores de 18 anos não podem ser cadastrados.');
        }

        if ($idade > 120) {
            throw new \Exception('Idade inválida.');
        }
    }

    public static function validaTelefone($telefone)
    {
        if (empty($telefone)) {
            throw new self('O telefone não pode ser vazio.');
        }

        if (! preg_match('/^\d{11}$/', $telefone)) {
            throw new self('O telefone deve conter 11 dígitos.');
        }
    }

    public static function validaCep($cep)
    {
        if (empty($cep)) {
            throw new self('O CEP não pode ser vazio.');
        }

        if (! preg_match('/^\d{8}$/', $cep)) {
            throw new self('O CEP deve conter 8 dígitos.');
        }
    }

    public static function validaBairro($bairro)
    {
        if (empty($bairro)) {
            throw new self('O bairro não pode ser vazio.');
        }

        if (! preg_match('/^[a-zA-Z\s]+$/', $bairro)) {
            throw new self('O bairro deve conter apenas letras e espaços.');
        }
    }

    public static function validaCidade($cidade)
    {
        if (empty($cidade)) {
            throw new self('A cidade não pode ser vazia.');
        }
    }

    public static function validaEstado($estado)
    {
        if (empty($estado)) {
            throw new self('O estado não pode ser vazio.');
        }

        if (! preg_match('/^[A-Z]{2}$/', $estado)) {
            throw new self('O estado deve conter apenas 2 letras.');
        }
    }

    public static function validaPerfil($perfil)
    {
        if (empty($perfil)) {
            throw new self('O perfil não pode ser vazio.');
        }

        if (! in_array($perfil, ['cliente', 'funcionario'])) {
            throw new self("O perfil deve ser 'cliente' ou 'funcionario'.");
        }
    }
}
