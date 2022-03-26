<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\Auth\Repository\AuthRepository;
use App\Repository\AuthRepositoryImpl;
use App\Domain\Post\Repository\PostRepository;
use App\Repository\PostRepositoryImpl;

class RepositoryProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(AuthRepository::class, AuthRepositoryImpl::class);
        $this->app->bind(PostRepository::class, PostRepositoryImpl::class);
    }
}
