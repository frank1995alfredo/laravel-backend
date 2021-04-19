<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResource('alumnos', 'AlumnoController');

/* CATEGORIAS */
Route::get('/listaCategoria', 'CategoriaController@index');
Route::post('/agregarCategoria', 'CategoriaController@store');
Route::get('/buscarCategoria/{id}', 'CategoriaController@show');
Route::put('/actualizarCategoria/{id}', 'CategoriaController@update');
Route::delete('/eliminarCategoria/{id}', 'CategoriaController@destroy');

/* PRODUCTOS */
Route::get('/listaProducto', 'ProductoController@index');
Route::post('/agregarProducto', 'ProductoController@store');
Route::get('/buscarProducto/{id}', 'ProductoController@show');
Route::put('/actualizarProducto/{id}', 'ProductoController@update');
Route::delete('/eliminarProducto/{id}', 'ProductoController@destroy');