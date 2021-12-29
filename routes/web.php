<?php

use App\Http\Controllers\InicioController;
use Illuminate\Support\Facades\Route;

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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/', 'InicioController@index')->name('inicio.index');

/** agreamos un Router nuevo */

//Route::get('/nosotros', 'RecetaController');
Route::get('/recetas', 'RecetasController@index')->name('recetas.index');
Route::get('/recetas/create', 'RecetasController@create')->name('recetas.create');
Route::post('/recetas', 'RecetasController@store')->name('recetas.store');
Route::get('/recetas/{reseta}', 'RecetasController@show')->name('recetas.show');
Route::get('recetas/{reseta}/edit','RecetasController@edit')->name('recetas.edit');
Route::put('/recetas/{receta}', 'RecetasController@update')->name('recetas.update');
Route::delete('/recetas/{receta}', 'RecetasController@destroy')->name('recetas.destroy');


Route::get('/perfiles/{perfil}', 'PerfilController@show')->name('perfiles.show');
Route::get('/perfiles/{perfil}/edit','PerfilController@edit')->name('perfiles.edit');
Route::put('/perfiles/{perfil}', 'PerfilController@update')->name('perfiles.update');

//Route::resource('perfiles','PerfilController');

//almacena los likes de las recetas
Route::post('/recetas/{receta}', 'LikeController@update')->name('likes.update');


Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
