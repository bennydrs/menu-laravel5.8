<?php

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

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.index');
});

Route::get('/menus', 'MenusController@index');
Route::get('/menus/create', 'MenusController@create');
Route::post('/menus', 'MenusController@store');
Route::get('/menus/{menu}/edit', 'MenusController@edit');
Route::patch('/menus/{menu}', 'MenusController@update');
Route::delete('/menus/{menu}', 'MenusController@destroy');

// atau bisa sbb:
// Route::resource('menus', 'MenusController');

Route::get('menus/sort-menu', 'MenusController@showSortMenu');
Route::post('menus/sort-menu', 'MenusController@updateOrder');
