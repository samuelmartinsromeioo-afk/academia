<?php

namespace App\Http\Controllers;

use App\Models\cadastro\academia as ModelsAcademia;
use App\Models\cadastro\Cliente as ModelsCliente;
use App\Models\cadastro\Personal as ModelsPersonal;
use App\Models\login;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        return view('login.index');
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
        // PERSONAL
    if ($personal = ModelsPersonal::where('email', $validated['email'])->first()) {
        if (Hash::check($validated['senha'], $personal->senha)) {
            return redirect()->route('personal.dashboard');
        }
    }

    // CLIENTE
    if ($aluno = ModelsCliente::where('email', $validated['email'])->first()) {
        if (Hash::check($validated['senha'], $aluno->senha)) {
            return redirect()->route('aluno.dashboard');
        }
    }

    // ACADEMIA
    if ($academia = ModelsAcademia::where('email', $validated['email'])->first()) {
        if (Hash::check($validated['senha'], $academia->senha)) {
            return redirect()->route('academia.dashboard');
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
