<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    require __DIR__.'/modules/pagina-inicial/route.php';
    require __DIR__.'/modules/pessoa/route.php';
    require __DIR__.'/modules/conta/route.php';
});

require __DIR__.'/auth.php';
