<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ApiTheMovie;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/api');
});

Route::get('/api', [ApiTheMovie::class, 'discover']);
Route::get('/movieById/{id}', [ApiTheMovie::class, 'movieById']);
Route::get('/search/{query}', [ApiTheMovie::class, 'search']);
