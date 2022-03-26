<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\Auth\Service\Contract\AuthService;
use App\Domain\Auth\Service\AuthServiceImpl;
use App\Domain\Post\Service\Contract\CreatePost;
use App\Domain\Post\Service\CreatePostImpl;

class AppServiceProvider extends ServiceProvider
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
        $this->app->bind(AuthService::class, AuthServiceImpl::class);
        $this->app->bind(CreatePost::class, CreatePostImpl::class);
    }
}
