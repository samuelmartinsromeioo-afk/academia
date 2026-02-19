<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\cadastro\SelecaoController;
use App\Http\Controllers\cadastro\PersonalController;
use App\Models\personal;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//tela inicial
Route::get('/', [LoginController::class, 'index'])->name('login.index');
//tela login
Route::post('/login', [LoginController::class, 'store'])->name('login.store');


// 1. Tela com os 3 botões de escolha
Route::get('/cadastro/selecionar', [SelecaoController::class, 'index'])->name('cadastro.selecao');
// 2. Rota que processa a escolha e redireciona
Route::get('/cadastro/ir-para/{tipo}', [SelecaoController::class, 'redirecionar'])->name('cadastro.ir');
// 3. As rotas dos formulários específicos (exemplos)
Route::get('/cadastro/personal', function() { return view('cadastros.personal'); })->name('form.personal');
Route::get('/cadastro/aluno', function() { return view('cadastros.aluno'); })->name('form.cliente');
Route::get('/cadastro/academia', function() { return view('cadastros.academia'); })->name('form.academia');


// Rota para mostrar o formulário
Route::get('/cadastro/personal', [PersonalController::class, 'create'])->name('personal.create');
// Rota para processar o formulário
Route::post('/cadastro/personal', [PersonalController::class, 'store'])->name('personal.store');