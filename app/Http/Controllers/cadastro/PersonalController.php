<?php

namespace App\Http\Controllers\Cadastro; 

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use App\Models\cadastro\Personal; 

class PersonalController extends Controller
{
    // Exibe o formulário de cadastro específico
    public function create()
    {
        // Certifique-se que a view está em resources/views/cadastros/personal.blade.php
        return view('cadastro.personal');
    }

    // Salva os dados no banco
    public function store(Request $request)
    {
        // Validamos e guardamos os dados em uma variável
        $dados = $request->validate([
            'nome'=> 'required|string|max:255',
            'cep'=>'required|string|max:8',
            'rua'=>'required|string|max:300',
            'bairro'=>'required|string|max:200',
            'cidade'=>'required|string|max:200',
            'estado'=>'required|string|max:200',
            'complemento'=>'required|string|min:1',
            'cpf' => 'required|unique:personals,cpf',
            'email'=> 'required|email|unique:personals,email',
            'certificado' => 'required|file|mimes:pdf,jpg,png|max:2048',
            'valor_secao' => 'required|numeric',
            'senha'    => 'required|string|min:8|confirmed',
            'idade' => 'required|date',
        ]);

        // Condição para salvar o arquivo
        if ($request->hasFile('certificado')) {
            // Salva o arquivo e atualiza o caminho no array $dados
            $caminho = $request->file('certificado')->store('certificados', 'public');
            $dados['certificado'] = $caminho;
        }

        Personal::create($dados);
        return redirect()->route('cadastro.selecao')->with('sucesso', 'Personal cadastrado com sucesso!');
        return redirect()->route('cadastro.SelecaoCadastro');
    }
}