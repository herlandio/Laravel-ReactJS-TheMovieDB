<?php

use App\Http\Controllers\ApiTheMovie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {return \Illuminate\Support\Facades\Redirect::to('/api/start');});
Route::get('/start', [ApiTheMovie::class, 'discover']);
Route::get('/movieById/{id}', [ApiTheMovie::class, 'movieById']);
Route::get('/search/{query}', [ApiTheMovie::class, 'search']);
