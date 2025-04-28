<?php

use App\Http\Controllers\PessoaController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'pessoa'],
    function () {
        Route::get('/', [PessoaController::class, 'listar'])->name('pessoa.listar');
        Route::get('/cadastrar', [PessoaController::class, 'formulario'])->name('pessoa.cadastrar');
        Route::get('/{id}/editar', [PessoaController::class, 'formulario'])->name('pessoa.editar');
        Route::get('/{id}/deletar', [PessoaController::class, 'deletar'])->name('pessoa.deletar');
        Route::get('/{id}/exibir', [PessoaController::class, 'exibir'])->name('pessoa.exibir');
        Route::post('/salvar', [PessoaController::class, 'salvar'])->name('pessoa.salvar');
    }
);
