<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\Auth\Service\Contract\AuthService;
use App\Domain\Auth\Service\AuthServiceImpl;
use App\Domain\Post\Service\Contract\CreatePost;
use App\Domain\Post\Service\CreatePostImpl;
use App\Domain\Post\Service\Contract\GetPost;
use App\Domain\Post\Service\GetPostImpl;
use App\Domain\Post\Service\Contract\DeletePost;
use App\Domain\Post\Service\DeletePostImpl;
use App\Domain\Post\Service\Contract\FollowUser;
use App\Domain\Post\Service\FollowUserImpl;
use App\Domain\Post\Service\Contract\ReplyPost;
use App\Domain\Post\Service\ReplyPostImpl;
use App\Domain\Post\Service\Contract\FavoritePost;
use App\Domain\Post\Service\FavoritePostImpl;
use App\Domain\Post\Service\Contract\StarPost;
use App\Domain\Post\Service\StarPostImpl;
use App\Domain\Post\Service\Contract\SharePost;
use App\Domain\Post\Service\SharePostImpl;
use App\Domain\Post\Service\Contract\GetAuth;
use App\Domain\Post\Service\GetAuthImpl;

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
        $this->app->bind(GetPost::class, GetPostImpl::class);
        $this->app->bind(DeletePost::class, DeletePostImpl::class);
        $this->app->bind(FollowUser::class, FollowUserImpl::class);
        $this->app->bind(ReplyPost::class, ReplyPostImpl::class);
        $this->app->bind(FavoritePost::class, FavoritePostImpl::class);
        $this->app->bind(StarPost::class, StarPostImpl::class);
        $this->app->bind(SharePost::class, SharePostImpl::class);
        $this->app->bind(GetAuth::class, GetAuthImpl::class);
    }
}
