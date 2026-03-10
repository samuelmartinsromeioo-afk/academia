<?php

namespace App\Http\Controllers\cadastro;


use App\Http\Controllers\Controller;
use App\Models\cadastro\Cliente;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //return view('cliente.index');
    }

    /**
     * Show the form for creating a new resource.
     */
  public function create()
    {

        return view('cadastro.cliente'); // ajuste para o nome da sua view
     
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
            'cep'=>'required|string|max:9',
            'rua'=>'required|string|max:300',
            'bairro'=>'required|string|max:200',
            'cidade'=>'required|string|max:200',
            'estado'=>'required|string|max:200',
            'complemento'=>'required|string|min:1',
            'altura' => 'required|numeric|min:0',
            'peso' => 'required|numeric|min:0',
            'idade' => 'required|date',
            'sexo' => 'required|in:Masculino,Feminino,Outro',
            'frequencia_semanal' => 'required|integer|min:0|max:7',
            'resumo_objetivo' => 'required|string|max:255',
            'condicao_clinica' => 'nullable|string|max:255'
        ]);

        // Criptografar senha
        $validated['senha'] = Hash::make($validated['senha']);

        Cliente::create($validated);

        return redirect()->route('login.index')
       ->with('success', 'Cliente cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cliente $cliente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        //
    }
}
