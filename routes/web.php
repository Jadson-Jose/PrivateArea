<?php


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

Route::get('/', 'main@index')->name('index');
Route::get('/login', 'main@login')->name('login');
Route::post('/login_submit', 'main@login_submit')->name('login_submit');

Route::get('/home', 'main@home')->name('home');
Route::get('/logout', 'main@logout')->name('logout');

Route::get('/edit/{id_usuario}', 'main@edit')->name('main_edit');
Route::get('/final/{hash}', 'main@final')->name('main_final');

Route::get('/edit/{id_usuario}', 'main@edit')->name('main_edit');

Route::post('/upload', 'main@upload')->name('main_upload');

Route::get('/lista_arquivos', 'main@lista_arquivos')->name('main_lista_arquivos');
Route::get('/download/{file}', 'main@download')->name('main_download');
