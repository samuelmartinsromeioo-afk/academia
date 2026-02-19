<?php

// 1. Atualize o namespace para refletir a nova pasta
namespace App\Http\Controllers\Cadastro; 

// 2. Importe o Controller base (senão o 'extends' falha)
use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
// 3. Verifique se o caminho do seu Model está correto (Geralmente é App\Models\Personal)
use App\cadastro\Models\Personal; 

class PersonalController extends Controller
{
    // Exibe o formulário de cadastro específico
    public function create()
    {
        // Certifique-se que a view está em resources/views/cadastros/personal.blade.php
        return view('cadastros.personal');
    }

    // Salva os dados no banco
    public function store(Request $request)
    {
        // Validamos e guardamos os dados em uma variável
        $dados = $request->validate([
            'nome'        => 'required|string|max:255',
            'cpf'         => 'required|unique:personal,cpf',
            'email'       => 'required|email|unique:personal,email',
            'certificado' => 'required|file|mimes:pdf,jpg,png|max:2048',
            'valor_secao' => 'required|numeric',
            'idade'       => 'required|date',
        ]);

        // Condição para salvar o arquivo
        if ($request->hasFile('certificado')) {
            // Salva o arquivo e atualiza o caminho no array $dados
            $caminho = $request->file('certificado')->store('certificados', 'public');
            $dados['certificado'] = $caminho;
        }

        Personal::create($dados);
        return redirect()->route('cadastro.selecao')->with('sucesso', 'Personal cadastrado com sucesso!');
    }
}