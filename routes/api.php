<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Domain\Auth\Controller\Login;
use App\Domain\Auth\Controller\Logout;
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
});
