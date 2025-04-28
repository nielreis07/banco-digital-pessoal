<?php

namespace App\Http\Controllers;

class PaginaInicialController extends Controller
{
    public function index()
    {
        return view('modules.pagina-inicial.index');
    }
}
