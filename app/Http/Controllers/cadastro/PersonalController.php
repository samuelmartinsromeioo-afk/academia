<?php

namespace App\Http\Controllers\Cadastro; 

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use App\Models\cadastro\Personal; 
use Illuminate\Support\Facades\Http;
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
        'nome'          => 'required|string|max:255',
        'cep'           => 'required|string|max:9', // Aumentado para 9 por causa do hífen
        'rua'           => 'required|string|max:300',
        'bairro'        => 'required|string|max:200',
        'cidade'        => 'required|string|max:200',
        'estado'        => 'required|string|max:200',
        'complemento'   => 'required|string|min:1',
        'cpf'           => 'required|unique:personals,cpf',
        'email'         => 'required|email|unique:personals,email',
        'certificado'   => 'required|file|mimes:pdf,jpg,png|max:2048',
        'valor_secao'   => 'required|numeric',
        'senha'         => 'required|string|min:8|confirmed',
        'idade'         => 'required|date',
        // Validamos como opcionais aqui
        'resultados'    => 'nullable|string',
        'avaliacao'     => 'nullable|string',
        ]);

        // Condição para salvar o arquivo
        if ($request->hasFile('certificado')) {
            // Salva o arquivo e atualiza o caminho no array $dados
            $caminho = $request->file('certificado')->store('certificados', 'public');
            $dados['certificado'] = $caminho;
        }

        $dados['senha'] = bcrypt($request->senha); // Criptografa a senha
        $dados['avaliacao'] = 'Aguardando avaliação inicial'; // Define o texto padrão
        $dados['resultados'] = 'Nenhum resultado registrado'; // Define o texto padrão
        $dados['agenda'] = 'disponivel'; // Valor para o ENUM da sua migration
       

        Personal::create($dados);
        return redirect()->route('login.index')->with('sucesso', 'Personal cadastrado com sucesso!');
        return redirect()->route('cadastro.SelecaoCadastro');
    }

  
   
}