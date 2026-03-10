<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Cadastro\SelecaoController;
use App\Http\Controllers\Cadastro\PersonalController;
use App\Http\Controllers\Cadastro\AcademiaController;
use App\Http\Controllers\Cadastro\ClienteController;
use App\Http\Controllers\App\AlunoController;


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

Route::get('/cadastro/ir-cadastro/{tipo}', [SelecaoController::class, 'redirecionar'])->name('cadastro.ir');


// 3. As rotas dos formulários específicos 



Route::get('/cadastro/cliente', [ClienteController::class, 'create'])->name('form.cliente');
Route::post('/cadastro/cliente', [ClienteController::class, 'store'])->name('cliente.store');

Route::get('/cadastro/personal', [PersonalController::class, 'create'])->name('form.personal');
Route::post('/cadastro/personal', [PersonalController::class, 'store'])->name('personal.store');


Route::get('/cadastro/academia', [AcademiaController::class, 'create'])->name('form.academia');
Route::post('/cadastro/academia', [AcademiaController::class, 'store'])->name('academia.store');

Route::get('/cliente', [AlunoController::class, 'index'])->name('cliente.index');
Route::post('/cliente/buscar', [AlunoController::class, 'buscarProximos'])->name('cliente.buscar');

