<?php

namespace App\Http\Controllers;

use App\Models\login;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class loginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $login = login::all();
        return view('login.index', compact('login'));
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
            'tipo_usuario' => 'required|in:aluno,personal,academia'
        ]);
        /*$login = login::where('email', $validated['email'])->first();

        if (!$login || !Hash::check($validated['senha'], $login->senha)) {
            return response()->json([
                'message' => 'Credenciais inválidas'
            ], 401);
        }*/
        login::create($validated);
        return redirect()->route('login.index');
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
