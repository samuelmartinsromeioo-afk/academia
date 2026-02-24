<?php

namespace App\Http\Controllers;

use App\cadastro\Models\academia;
use Illuminate\Http\Request;

class academiaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $validated=$request->validade([
        'nome'=>'required|string|max:255',
        'endereco'=>'required|string|max:255',
        'valor'=>'required|decimal|max:255',
        'descricao'=>'required|text|max:255',
        'infraestrutura'=>'required|text|max:255',
        'tipos_aulas'=>'required|text|max:255'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(academia $academia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(academia $academia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, academia $academia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(academia $academia)
    {
        //
    }
}
