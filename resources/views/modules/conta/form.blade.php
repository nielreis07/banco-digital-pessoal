@extends('adminlte::page')

@section('title', 'Usuário')

@section('content')
<div class="container pt-4">
    <!-- Exibir mensagens -->
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
            <div class="row">
                <div class="col-md-12">
                    <h2>Cadastro de Conta</h2>
                </div>
                <div class="col-md-12">
                    <form action="{{ route('conta.salvar') }}" method="POST">
                        @csrf
                        <input type="hidden" name="pessoa_id" value="{{ $response?->conta?->pessoa_id ?? $response?->pessoaId }}">
                        <input type="hidden" name="id" value="{{ $response?->conta?->id ?? '' }}">
                        <div class="row">

                            @if (isset($response?->conta?->pessoa))
                            <div class="col-md-4 mb-3">
                                <div class="card p-2">
                                    <label for="nome" class="form-label text-lightblue">Nome</label>
                                    <div>{{ $response?->conta?->pessoa?->nome ?? '-' }}</div>
                                </div>
                            </div>
                            @endif

                            <div class="col-md-4">
                                <label for="numero" class="form-label text-lightblue">Número da Conta</label>
                                <input type="text"
                                    class="form-control"
                                    id="numero"
                                    name="numero"
                                    value="{{ old('numero', $response?->conta?->numero ?? str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT)) }}"
                                    required>
                            </div>
                            <div class="col-md-4">
                                <label for="agencia" class="form-label text-lightblue">Agência</label>
                                <input type="text"
                                    class="form-control"
                                    id="agencia"
                                    name="agencia"
                                    value="{{ old('agencia', $response?->conta?->agencia ?? str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT)) }}"
                                    required>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <label for="codigo_verificador" class="form-label text-lightblue">CV</label>
                                <input type="text"
                                    class="form-control"
                                    id="codigo_"
                                    name="codigo_verificador"
                                    value="{{ old('codigo_verificador', $response?->conta?->codigoVerificador ?? str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT)) }}"
                                    required>
                            </div>

                            <div class="col-md-4">
                                <x-adminlte-select2 name="tipo" label="Tipo de conta" label-class="text-lightblue"
                                    igroup-size="lg" data-placeholder="Selecione uma opção...">
                                    <option value="">Selecione</option>
                                    <option value="corrente" @selected(old('conta', $response?->conta?->tipo ?? '')=='corrente' )>Corrente</option>
                                    <option value="poupanca" @selected(old('conta', $response?->conta?->tipo ?? '')=='poupanca' )>Poupança</option>
                                </x-adminlte-select2>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary mt-3">Salvar</button>
                                <a href="{{ route('conta.listar') }}" class="btn btn-secondary mt-3">Voltar</a>
                            </div>
                        </div>
                    </form>
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
    moment.locale('pt-br');
</script>
@endsection