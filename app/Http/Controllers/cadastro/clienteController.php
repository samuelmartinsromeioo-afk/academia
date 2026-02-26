<?php

namespace App\Http\Controllers;

use App\cadastro\Models\cliente;
use Illuminate\Http\Request;

class clienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('cadastros.cliente');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:clientes,email',
            'senha' => 'required|string|min:6|max:255',
            'altura' => 'required|numeric|min:0',
            'peso' => 'required|numeric|min:0',
            'idade' => 'required|date',
            'sexo' => 'required|in:Masculino,Feminino',
            'frequencia_semanal' => 'required|integer|min:0|max:7',
            'resumo_objetivo' => 'required|string|max:255',
            'condicao_clinica' => 'nullable|string|max:255'
        ]);

        // Criptografar senha
        $validated['senha'] = Hash::make($validated['senha']);

        cliente::create($validated);

        return redirect()->back()->with('success', 'Cliente cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, cliente $cliente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(cliente $cliente)
    {
        //
    }
}
