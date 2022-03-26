<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Domain\Auth\Controller\Login;
use App\Domain\Auth\Controller\Logout;
use App\Domain\Post\Controller\CreatePost;
use App\Domain\Post\Controller\GetPost;
use App\Domain\Post\Controller\GetSinglePost;
use App\Domain\Post\Controller\DeletePost;
use App\Domain\Post\Controller\FollowUser;
use App\Domain\Post\Controller\ReplyPost;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', Login::class);
Route::middleware(['jwt.auth'])->group(function () {
    Route::post('/logout', Logout::class);
    Route::post('/posts', CreatePost::class);
    Route::get('/posts', GetPost::class);
    Route::get('/posts/{id}', GetSinglePost::class)->where('id', '^([0-9]|[1-9][0-9]+)$');
    Route::delete('/posts/{id}', DeletePost::class)->where('id', '^([0-9]|[1-9][0-9]+)$');

    Route::post('/follow', FollowUser::class);
    Route::post('/posts/{id}/reply', ReplyPost::class);
    // Route::post('/posts/{id}/favorite', Logout::class);
    // Route::post('/posts/{id}/star', Logout::class);
    // Route::post('/posts/{id}/share', Logout::class);
});

//  Route::post('/logout', Logout::class);