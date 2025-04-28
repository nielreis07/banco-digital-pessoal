@extends('adminlte::page')

@section('title', 'Usuário')

@section('content')
<div class="container pt-4">

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
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
        <div class="card-header">
            <h2 class="mb-0">Exibir Dados do Usuário</h2>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="card p-2">
                        <label class="form-label text-lightblue">Nome</label>
                        <div>{{ $response?->pessoa?->nome ?? '-' }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p-2">
                        <label class="form-label text-lightblue">CPF</label>
                        <div>{{ $response?->pessoa?->cpf ?? '-' }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p-2">
                        <label class="form-label text-lightblue">Data de Nascimento</label>
                        <div>{{ $response?->pessoa?->data_nascimento ?? '-' }}</div>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-4">
                    <div class="card p-2">
                        <label class="form-label text-lightblue">Usuário</label>
                        <div>{{ $response?->usuario?->name ?? '-' }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p-2">
                        <label class="form-label text-lightblue">Telefone</label>
                        <div>{{ $response?->pessoa?->telefone ?? '-' }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p-2">
                        <label class="form-label text-lightblue">CEP</label>
                        <div>{{ $response?->pessoa?->cep ?? '-' }}</div>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-4">
                    <div class="card p-2">
                        <label class="form-label text-lightblue">Bairro</label>
                        <div>{{ $response?->pessoa?->bairro ?? '-' }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p-2">
                        <label class="form-label text-lightblue">Cidade</label>
                        <div>{{ $response?->pessoa?->cidade ?? '-' }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p-2">
                        <label class="form-label text-lightblue">UF</label>
                        <div>{{ $response?->pessoa?->estado ?? '-' }}</div>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6">
                    <div class="card p-2">
                        <label class="form-label text-lightblue">Complemento</label>
                        <div>{{ $response?->pessoa?->complemento ?? '-' }}</div>
                    </div>
                </div>
                <div class="col-md-4 mt-3 mt-md-0">
                    <div class="card p-2">
                        <label class="form-label text-lightblue">Perfil</label>
                        <div>{{ $response?->pessoa?->perfil_descricao ?? '-' }}</div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-12">
                    <a href="{{ route('pessoa.listar') }}" class="btn btn-secondary">Voltar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('plugins.Select2', true)
@section('plugins.TempusDominusBs4', true)

@section('js')
<script>
    moment.locale('pt-br');
</script>
@endsection
