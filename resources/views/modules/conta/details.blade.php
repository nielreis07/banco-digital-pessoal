@extends('adminlte::page')

@section('title', 'Usuário')

@section('content')

<div class="container pt-4">

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $erro)
            <li>{{ $erro }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-12">
                    <h2>Exibir Dados da Conta</h2>
                </div>
            </div>

            <div class="row">
                @if (isset($response?->conta?->pessoa))
                <div class="col-md-4 mb-3">
                    <div class="card p-2">
                        <label for="nome" class="form-label text-lightblue">Nome</label>
                        <div>{{ $response?->conta?->pessoa?->nome ?? '-' }}</div>
                    </div>
                </div>
                @endif

                <div class="col-md-4 mb-3">
                    <div class="card p-2">
                        <label for="numero" class="form-label text-lightblue">Número da Conta</label>
                        <div>{{ $response?->conta?->numero ?? str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT) }}</div>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="card p-2">
                        <label for="agencia" class="form-label text-lightblue">Agência</label>
                        <div>{{ $response?->conta?->agencia ?? str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT) }}</div>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="card p-2">
                        <label for="tipo" class="form-label text-lightblue">Tipo</label>
                        <div>{{ $response?->conta?->tipo_descricao ?? '-' }}</div>
                    </div>
                </div>

                <div class="col-md-4 mt-3">
                    <div class="card p-2">
                        <label for="saldo" class="form-label text-lightblue">Saldo</label>
                        <input type="text"
                            class="form-control"
                            id="saldo"
                            name="saldo"
                            placeholder="R$ 0,00"
                            value="{{ old('saldo', $response?->conta?->saldo ?? '0,00') }}"
                            readonly
                            style="background-color:rgb(255, 255, 255);">
                        @error('saldo')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-12">
                    <a href="{{ route('conta.listar') }}" class="btn btn-secondary">Voltar</a>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-body">
            <form action="{{ route('conta.operacao-bancaria') }}" method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" name="idContaOrdenador" value="{{ $response?->conta?->id }}">
                <input type="hidden" name="idPessoa" value="{{ $response?->conta?->pessoa?->id }}">

                <div class="row mb-2">
                    <div class="col-md-12">
                        <h2>Transferência</h2>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-12">
                        <x-adminlte-select2 name="operacao" label="Tipo de Operação" label-class="text-lightblue"
                            igroup-size="lg" data-placeholder="Selecione uma opção...">
                            <option value="">Selecione</option>
                            <option value="saque">Saque</option>
                            <option value="deposito">Depósito</option>
                            <option value="transferencia">Transferência</option>
                        </x-adminlte-select2>
                    </div>
                </div>

                <div class="row mb-2 operacao-transferir">
                    <div class="col-md-12">
                        <x-adminlte-select2 name="idContaBeneficiario" label="Conta Beneficiário" label-class="text-lightblue"
                            igroup-size="lg" data-placeholder="Selecione uma opção...">
                            <option value="">Selecione</option>
                            @foreach($response?->pessoas as $valor)
                                @if (!empty($valor?->conta))
                                    <option value="{{ $valor?->conta?->id }}">
                                        {{ $valor?->nome }}
                                    </option>
                                @endif
                            @endforeach
                        </x-adminlte-select2>
                    </div>
                </div>

                <div class="row mb-2 operacao-transferir">
                    <div class="col-md-4 col-12">
                        <x-adminlte-select2 name="tipo" label="Tipo de conta" label-class="text-lightblue"
                            igroup-size="lg" data-placeholder="Selecione uma opção...">
                            <option value="">Selecione</option>
                            <option value="corrente">Corrente</option>
                            <option value="poupanca">Poupança</option>
                        </x-adminlte-select2>
                    </div>

                    <div class="col-md-4 col-12">
                        <label for="numero" class="form-label text-lightblue">Número da Conta</label>
                        <input type="text"
                            class="form-control"
                            id="numero"
                            name="numero"
                            value="">
                    </div>

                    <div class="col-md-4 col-12">
                        <label for="agencia" class="form-label text-lightblue">Agência</label>
                        <input type="text"
                            class="form-control"
                            id="agencia"
                            name="agencia"
                            value="">
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-3 mt-3">
                        <label for="valor" class="form-label text-lightblue">Valor</label>
                        <input type="text"
                            class="form-control"
                            id="valor"
                            name="valor"
                            placeholder="R$ 0,00"
                            value="">
                        @error('valor')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary mt-3">Confirmar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card mt-4">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Extrato</h2>
        </div>

          <div class="card">
      <div class="card-body">
          <x-adminlte-datatable id="table1" :heads="$response->heads">
              @foreach($response->extrato as $row)
                  <tr>
                      @foreach($row as $cell)
                          <td>{!! $cell !!}</td>
                      @endforeach
                  </tr>
              @endforeach
          </x-adminlte-datatable>
      </div>
    </div>
        
    </div>
</div>

</div>
    </div>
@endsection

@section('plugins.TempusDominusBs4', true)
@section('plugins.Select2', true)

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        moment.locale('pt-br');

        const elementsToHide = document.querySelectorAll('.operacao-transferir');
        elementsToHide.forEach(el => el.style.display = 'none');

        const operacaoSelect = $('select[name="operacao"]');

        operacaoSelect.on('change', function () {
            const operacao = $(this).val();
            if (operacao === 'transferencia') {
                elementsToHide.forEach(el => el.style.display = 'flex');
            } else {
                elementsToHide.forEach(el => el.style.display = 'none');
            }
        });
    });
</script>
@endsection