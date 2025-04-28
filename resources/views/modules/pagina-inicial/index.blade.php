@extends('adminlte::page')

@section('title', 'Escolha sua Conta')

@section('content_header')
    <h1 class="text-center text-dark font-weight-bold">Abra sua Conta com BDP</h1>
@stop

@section('content')
    {{-- Seção de Introdução --}}
    <div class="card shadow-sm border-0">
        <div class="card-body text-center">
            <h3 class="text-dark">Escolha a sua Conta Corrente ou Conta Poupança</h3>
            <p class="lead text-muted">Ambas as contas são digitais, práticas e sem tarifas escondidas.</p>
        </div>
    </div>

    {{-- Seção de Contas --}}
    <div class="row justify-content-center mt-4">
        
      {{-- Conta Corrente --}}
        <div class="col-md-5 mb-4">
            <div class="card border-light shadow-sm">
                <div class="card-header bg-primary text-white text-center">
                    <h4><i class="fas fa-university"></i> Conta Corrente</h4>
                </div>
                <div class="card-body text-center">
                    <p>Conta para o seu dia a dia. Com pagamentos, transferências e controle total pelo app.</p>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-check-circle"></i> Cartão de débito</li>
                        <li><i class="fas fa-check-circle"></i> Transferências ilimitadas</li>
                    </ul>
                    <a href="{{ route('pessoa.cadastrar') }}" class="btn btn-outline-primary btn-lg btn-block">Abrir Conta Corrente</a>
                </div>
            </div>
        </div>

        {{-- Conta Poupança --}}
        <div class="col-md-5 mb-4">
            <div class="card border-light shadow-sm">
                <div class="card-header bg-success text-white text-center">
                    <h4><i class="fas fa-piggy-bank"></i> Conta Poupança</h4>
                </div>
                <div class="card-body text-center">
                    <p>Ideal para quem quer poupar e ver seu dinheiro render. Simples e segura.</p>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-check-circle"></i> Rentabilidade mensal</li>
                        <li><i class="fas fa-check-circle"></i> Saques e transferências rápidos</li>
                    </ul>
                    <a href="{{ route('pessoa.cadastrar') }}" class="btn btn-outline-success btn-lg btn-block">Abrir Conta Poupança</a>
                </div>
            </div>
        </div>
    </div>
    
@stop
