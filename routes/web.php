<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
<<<<<<< HEAD
use App\Http\Controllers\Cadastro\SelecaoController;
use App\Http\Controllers\Cadastro\PersonalController;
use App\Http\Controllers\Cadastro\AcademiaController;
use App\Http\Controllers\ClienteController;
=======
use App\Http\Controllers\cadastro\SelecaoController;
use App\Http\Controllers\cadastro\PersonalController;
use App\Http\Controllers\cadastro\clienteController;
>>>>>>> 6330619cb9d55d0e6ec6701728ab6e60e0745d92
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
Route::get('/login',[LoginController::class,'create'])->name('login.create');


// 1. Tela com os 3 botões de escolha
Route::get('/cadastro/selecionar', [SelecaoController::class, 'index'])->name('cadastro.SelecaoCadastro');
// 2. Rota que processa a escolha e redireciona
Route::get('/cadastro/ir-para/{tipo}', [SelecaoController::class, 'redirecionar'])->name('cadastro.ir');
<<<<<<< HEAD

// 3. As rotas dos formulários específicos 


Route::get('/cadastro/cliente', [clienteController::class, 'create'])->name('form.cliente');

Route::get('/cadastro/personal', [PersonalController::class, 'create'])->name('form.personal');
Route::post('/cadastro/personal', [PersonalController::class, 'store'])->name('personal.store');


Route::get('/cadastro/academia', [AcademiaController::class, 'create'])->name('form.academia');
Route::post('/cadastro/academia', [AcademiaController::class, 'store'])->name('academia.store');


=======
// 3. As rotas dos formulários específicos (exemplos)
Route::get('/cadastro/personal', function() { return view('cadastros.personal'); })->name('form.personal');
Route::get('/cadastro/aluno', function() { return view('cadastros.cliente'); })->name('form.cliente');
Route::get('/cadastro/academia', function() { return view('cadastros.academia'); })->name('form.academia');


// Rota para mostrar o formulário
Route::get('/cadastro/personal', [PersonalController::class, 'create'])->name('form.personal');
// Rota para processar o formulário
Route::post('/cadastro/personal', [PersonalController::class, 'store'])->name('personal.store');
// Exibir formulário
Route::get('/cadastro/cliente', [clienteController::class, 'create'])->name('form.cliente');
// Salvar cliente
Route::post('/cadastro/cliente', [clienteController::class, 'store'])->name('cliente.store');
>>>>>>> 6330619cb9d55d0e6ec6701728ab6e60e0745d92
