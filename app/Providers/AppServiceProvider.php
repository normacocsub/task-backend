<?php

namespace App\Providers;

use App\Adapters\Repositories\EloquentUsuarioRepository;
use App\Core\Domain\Repositories\UsuarioRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(UsuarioRepositoryInterface::class, function ($app) {
            return new EloquentUsuarioRepository();
        });
    }

    public function boot()
    {
    }
}
