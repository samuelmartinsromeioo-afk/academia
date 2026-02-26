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
        'nome'=> 'required|string|max:255',
        'email'=> 'required|string|max:255',
        'senha'=>'required|string|max:255',
        'altura'=>'required|decimal',
        'peso'=>'required|decimal',
        'idade'=>'requered|date',
        'sexo'=>'requered|enum',
        'frequencia_semanal'=>'required|integer',
        'resumo_objetivo'=>'required|text|max:255',
        'condicao_clinica'=>'required|text|max:255'
        ]);
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
