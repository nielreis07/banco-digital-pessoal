<?php

use App\Http\Controllers\ContaController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'conta'],
    function () {
        Route::get('/', [ContaController::class, 'listar'])->name('conta.listar');
        Route::get('/salvar', [ContaController::class, 'salvar'])->name('conta.salvar');
        Route::get('/cadastrar/{id}/{pessoa_id}', [ContaController::class, 'formulario'])->name('conta.cadastrar');
        Route::get('/{id}/{pessoa_id}/editar', [ContaController::class, 'formulario'])->name('conta.editar');
        Route::get('/{id}/deletar', [ContaController::class, 'deletar'])->name('conta.deletar');
        Route::get('/{id}/{pessoa_id}/exibir', [ContaController::class, 'exibir'])->name('conta.exibir');
        Route::post('/salvar', [ContaController::class, 'salvar'])->name('conta.salvar');
        Route::put('/oeparacao-bancaria', [ContaController::class, 'operacaoBancaria'])->name('conta.operacao-bancaria');
    });
