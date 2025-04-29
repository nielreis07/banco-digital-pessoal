<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            'App\Http\Repositories\Pessoa\Interface\PessoaRepositoryInterface',
            'App\Http\Repositories\Pessoa\PessoaRepository'
        );

        $this->app->bind(
            'App\Http\Repositories\Usuario\Interface\UsuarioRepositoryInterface',
            'App\Http\Repositories\Usuario\UsuarioRepository'
        );

        $this->app->bind(
            'App\Http\Repositories\Conta\Interface\ContaRepositoryInterface',
            'App\Http\Repositories\Conta\ContaRepository'
        );

        $this->app->bind(
            'App\Http\Repositories\Extrato\Interface\ExtratoRepositoryInterface',
            'App\Http\Repositories\Extrato\ExtratoRepository'
        );
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
