<?php

namespace App\Http\Controllers;

use App\Models\login;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\cadastro\Personal;
use App\Models\cadastro\Aluno;
use App\Models\cadastro\academia;
class loginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        return view('login.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('login.cadastrar');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|string|max:255',
            'senha' => 'required|string|max:255',
        ]);
        if(!$validated['email'] || !$validated['senha']){
            return redirect()->route('login.index')->withErrors(['email' => 'Email e senha são obrigatórios.']);
        }
        if($personal = Personal::where('email', $validated['email'])->first()){
            if ($personal && $personal->senha === $validated['senha']) {
                // Autenticação bem-sucedida para Personal
                return redirect()->route('personal.dashboard'); // Redireciona para o dashboard do Personal
            }
        }
        if($aluno = Aluno::where('email', $validated['email'])->first()){
            if ($aluno && $aluno->senha === $validated['senha']) {
                // Autenticação bem-sucedida para Aluno
                return redirect()->route('aluno.dashboard'); // Redireciona para o dashboard do Aluno
            }
        }
        if($academia = academia::where('email', $validated['email'])->first()){
            if ($academia && $academia->senha === $validated['senha']) {
                // Autenticação bem-sucedida para Academia
                return redirect()->route('academia.dashboard'); // Redireciona para o dashboard da Academia
            }
        }
        
       
        
        
        return redirect()->route('login.index')->withErrors(['email' => 'Credenciais inválidas.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(login $login)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(login $login)
    {
       
        return redirect()->route('login.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, login $login)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(login $login)
    {
        $login->delete();
        return redirect()->route('login.index');
    }
}
