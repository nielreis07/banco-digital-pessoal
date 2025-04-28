<?php

use App\Http\Controllers\PaginaInicialController;
use Illuminate\Support\Facades\Route;

Route::get('pagina-inicial', [PaginaInicialController::class, 'index'])->name('pagina-inicial.index');
