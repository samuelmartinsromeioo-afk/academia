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
        $logins = login::all();
        return view('logins.index', compact('logins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('logins.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'usuario' => 'required|string|max:255',
            'senha' => 'required|string|max:255',
            'tipo_usuario' => 'required|in:aluno,personal,academia'
        ]);

        login::create($validated);
        return redirect()->route('logins.index');
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
        $validated = $request->validate([
            'usuario' => 'required|string|max:255',
            'senha' => 'required|string|max:255',
            'tipo_usuario' => 'required|in:aluno,personal,academia'
        ]);
        $login->update($validated);
        return redirect()->route('logins.index');
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
        return redirect()->route('logins.index');
    }
}
