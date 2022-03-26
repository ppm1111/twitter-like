<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\Auth\Repository\AuthRepository;
use App\Repository\AuthRepositoryImpl;
use App\Domain\Post\Repository\PostRepository;
use App\Repository\PostRepositoryImpl;
use App\Domain\Post\Repository\AuthRepository as PostAuthRepository;
use App\Repository\PostAuthRepositoryImpl;
use App\Domain\Post\Repository\UserRepository;
use App\Repository\UserRepositoryImpl;
use App\Domain\Post\Repository\ReplyRepository;
use App\Repository\ReplyRepositoryImpl;
use App\Domain\Post\Repository\StarRecordRepository;
use App\Repository\StarRecordRepositoryImpl;
use App\Domain\Post\Repository\SharePostRepository;
use App\Repository\SharePostRepositoryImpl;

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
        $this->app->bind(PostAuthRepository::class, PostAuthRepositoryImpl::class);
        $this->app->bind(UserRepository::class, UserRepositoryImpl::class);
        $this->app->bind(ReplyRepository::class, ReplyRepositoryImpl::class);
        $this->app->bind(StarRecordRepository::class, StarRecordRepositoryImpl::class);
        $this->app->bind(SharePostRepository::class, SharePostRepositoryImpl::class);
    }
}
