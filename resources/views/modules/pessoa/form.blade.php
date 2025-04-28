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
                    <h2>Cadastro de Pessoa</h2>
                </div>
                <div class="col-md-12">
                    <form action="{{ route('pessoa.salvar') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $response?->pessoa?->id }}">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="nome" class="form-label text-lightblue">Nome</label>
                                <input type="text" class="form-control" id="nome" name="nome" value="{{ old('nome', $response?->pessoa?->nome) }}" required>
                            </div>

                            <div class="col-md-4">
                                <label for="cpf" class="form-label text-lightblue">CPF</label>
                                <input type="text" class="form-control" id="cpf" name="cpf" value="{{ old('cpf', $response?->pessoa?->cpf) }}" required>
                            </div>

                            <div class="col-md-4">
                                <label for="data_nascimento" class="form-label text-lightblue">Data de Nascimento</label>
                                <x-adminlte-input-date name="data_nascimento" value="{{ old('data_nascimento', $response?->pessoa?->data_nascimento) }}" />
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <x-adminlte-select2 name="usuario_id" label="Usuário" label-class="text-lightblue"
                                    igroup-size="lg" data-placeholder="Selecione uma opção...">
                                    <option value="">Selecione</option>
                                    @foreach($response?->usuarios as $chave => $valor)
                                    <option value="{{ $chave }}"
                                        @selected(old('usuario_id', $response?->pessoa?->usuario_id)==$chave)>
                                        {{ $valor }}
                                    </option>
                                    @endforeach
                                </x-adminlte-select2>
                            </div>

                            <div class="col-md-4">
                                <label for="telefone" class="form-label text-lightblue">Telefone</label>
                                <input type="text" class="form-control" id="telefone" name="telefone" value="{{ old('telefone', $response?->pessoa?->telefone) }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <label for="cep" class="form-label text-lightblue">CEP</label>
                                <input type="text" class="form-control" id="cep" name="cep" value="{{ old('cep', $response?->pessoa?->cep) }}" required>
                            </div>

                            <div class="col-md-3">
                                <label for="bairro" class="form-label text-lightblue">Bairro</label>
                                <input type="text" class="form-control" id="bairro" name="bairro" value="{{ old('bairro', $response?->pessoa?->bairro) }}" required>
                            </div>

                            <div class="col-md-3">
                                <label for="cidade" class="form-label text-lightblue">Cidade</label>
                                <input type="text" class="form-control" id="cidade" name="cidade" value="{{ old('cidade', $response?->pessoa?->cidade) }}" required>
                            </div>

                            <div class="col-md-3">
                                <x-adminlte-select2 name="estado" label="UF" label-class="text-lightblue"
                                    igroup-size="lg" data-placeholder="Selecione uma opção...">
                                    <option value="">Selecione</option>
                                    <option value="AC" @selected(old('estado', $response?->pessoa?->estado)=='AC')>Acre</option>
                                    <option value="AL" @selected(old('estado', $response?->pessoa?->estado)=='AL')>Alagoas</option>
                                    <option value="AP" @selected(old('estado', $response?->pessoa?->estado)=='AP')>Amapá</option>
                                    <option value="AM" @selected(old('estado', $response?->pessoa?->estado)=='AM')>Amazonas</option>
                                    <option value="BA" @selected(old('estado', $response?->pessoa?->estado)=='BA')>Bahia</option>
                                    <option value="CE" @selected(old('estado', $response?->pessoa?->estado)=='CE')>Ceará</option>
                                    <option value="DF" @selected(old('estado', $response?->pessoa?->estado)=='DF')>Distrito Federal</option>
                                    <option value="ES" @selected(old('estado', $response?->pessoa?->estado)=='ES')>Espírito Santo</option>
                                    <option value="GO" @selected(old('estado', $response?->pessoa?->estado)=='GO')>Goiás</option>
                                    <option value="MA" @selected(old('estado', $response?->pessoa?->estado)=='MA')>Maranhão</option>
                                    <option value="MT" @selected(old('estado', $response?->pessoa?->estado)=='MT')>Mato Grosso</option>
                                    <option value="MS" @selected(old('estado', $response?->pessoa?->estado)=='MS')>Mato Grosso do Sul</option>
                                    <option value="MG" @selected(old('estado', $response?->pessoa?->estado)=='MG')>Minas Gerais</option>
                                    <option value="PA" @selected(old('estado', $response?->pessoa?->estado)=='PA')>Pará</option>
                                    <option value="PB" @selected(old('estado', $response?->pessoa?->estado)=='PB')>Paraíba</option>
                                    <option value="PR" @selected(old('estado', $response?->pessoa?->estado)=='PR')>Paraná</option>
                                    <option value="PE" @selected(old('estado', $response?->pessoa?->estado)=='PE')>Pernambuco</option>
                                    <option value="PI" @selected(old('estado', $response?->pessoa?->estado)=='PI')>Piauí</option>
                                    <option value="RJ" @selected(old('estado', $response?->pessoa?->estado)=='RJ')>Rio de Janeiro</option>
                                    <option value="RN" @selected(old('estado', $response?->pessoa?->estado)=='RN')>Rio Grande do Norte</option>
                                    <option value="RS" @selected(old('estado', $response?->pessoa?->estado)=='RS')>Rio Grande do Sul</option>
                                    <option value="RO" @selected(old('estado', $response?->pessoa?->estado)=='RO')>Rondônia</option>
                                    <option value="RR" @selected(old('estado', $response?->pessoa?->estado)=='RR')>Roraima</option>
                                    <option value="SC" @selected(old('estado', $response?->pessoa?->estado)=='SC')>Santa Catarina</option>
                                    <option value="SP" @selected(old('estado', $response?->pessoa?->estado)=='SP')>São Paulo</option>
                                    <option value="SE" @selected(old('estado', $response?->pessoa?->estado)=='SE')>Sergipe</option>
                                    <option value="TO" @selected(old('estado', $response?->pessoa?->estado)=='TO')>Tocantins</option>
                                </x-adminlte-select2>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="endereco" class="form-label text-lightblue">Endereço</label>
                                <input type="text" class="form-control" id="endereco" name="endereco" value="{{ old('endereco', $response?->pessoa?->nome) }}" required>
                            </div>

                            <div class="col-md-6">
                                <label for="complemento" class="form-label text-lightblue">Complemento</label>
                                <input type="text" class="form-control" id="complemento" name="complemento" value="{{ old('nome', $response?->pessoa?->nome) }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <x-adminlte-select2 name="perfil" label="Perfil" label-class="text-lightblue"
                                    igroup-size="lg" data-placeholder="Selecione uma opção...">
                                    <option value="">Selecione</option>
                                    <option value="funcionario" @selected(old('perfil', $response?->pessoa?->perfil)=='funcionario' )>Funcionário</option>
                                    <option value="cliente" @selected(old('perfil', $response?->pessoa?->perfil)=='cliente' )>Cliente</option>
                                </x-adminlte-select2>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary mt-3">Salvar</button>
                                <a href="{{ route('pessoa.listar') }}" class="btn btn-secondary mt-3">Voltar</a>
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