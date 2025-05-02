<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OperacaoBancariaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'operacao' => 'required|in:saque,deposito,transferencia',
            'idContaBeneficiario' => 'required_if:operacao,transferencia|integer|exists:contas,id',
            'tipo' => 'required_if:operacao,transferencia|in:corrente,poupanca',
            'numero' => 'required_if:operacao,transferencia',
            'agencia' => 'required_if:operacao,transferencia',
            'valor' => 'required|numeric|min:0.01',
        ];
    }

    public function messages(): array
    {
        return [
            'operacao.required' => 'A operação é obrigatória.',
            'operacao.in' => 'A operação deve ser saque, deposito ou transferencia.',
            'idContaBeneficiario.required_if' => 'O ID da conta beneficiária é obrigatório para transferência.',
            'idContaBeneficiario.integer' => 'O ID da conta beneficiária deve ser um número inteiro.',
            'idContaBeneficiario.exists' => 'A conta beneficiária não existe.',
            'tipo.required_if' => 'O tipo de conta é obrigatório para transferência.',
            'tipo.in' => 'O tipo de conta deve ser Corrente ou Poupanca.',
            'numero.required_if' => 'O número da conta é obrigatório para transferência.',
            'agencia.required_if' => 'A agência é obrigatória para transferência.',
            'valor.required' => 'O valor é obrigatório.',
            'valor.numeric' => 'O valor deve ser um número.',
            'valor.min' => 'O valor deve ser maior que zero.',
        ];
    }
}
