<?php

use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\HomeController;
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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', [HomeController::class, 'index']);

Route::get('/fornecedor', [FornecedorController::class, 'index'])->name('fornecedores');;
Route::get('/fornecedor/list', [FornecedorController::class, 'list'])->name('lista_fornecedores');
Route::get('/fornecedor/create', [FornecedorController::class, 'create']);
Route::get('/fornecedor/{id}/ver', [FornecedorController::class, 'show']);
Route::get('/fornecedor/{id}/editar', [FornecedorController::class, 'show']);
Route::get('/fornecedor/{id}/remover', [FornecedorController::class, 'remove']);
Route::get('/fornecedor/{id}/excluir', [FornecedorController::class, 'destroy']);

Route::post('/fornecedor/store', [FornecedorController::class, 'store']);
Route::post('/fornecedor/{id}/update', [FornecedorController::class, 'update']);
