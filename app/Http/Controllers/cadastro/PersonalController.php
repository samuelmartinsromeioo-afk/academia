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
        // 🔎 buscar coordenadas
        $coords = $this->buscarCoordenadas($dados['cep']);

        if ($coords) {
            $dados['latitude'] = $coords['latitude'];
            $dados['longitude'] = $coords['longitude'];
        }

        Personal::create($dados);
        return redirect()->route('login.index')->with('sucesso', 'Personal cadastrado com sucesso!');
        return redirect()->route('cadastro.SelecaoCadastro');
    }

    /**
 * Buscar coordenadas (latitude e longitude) a partir do CEP.
 */
    private function buscarCoordenadas($cep)
    {
        // Remover caracteres não numéricos do CEP
        $cep = preg_replace('/[^0-9]/', '', $cep);

        // Consulta ViaCEP para validar o CEP
        $response = Http::get("https://viacep.com.br/ws/{$cep}/json/");

        if ($response->ok()) {
            $data = $response->json();

            // Aqui você poderia usar o logradouro, cidade, estado para chamar uma API de geolocalização
            // Exemplo: Google Maps API (você precisa da chave da API)
            
            $address = "{$data['logradouro']}, {$data['localidade']}, {$data['uf']}, Brasil";
            $geo = Http::get("https://maps.googleapis.com/maps/api/geocode/json", [
                'address' => $address,
                'key' => env('GOOGLE_MAPS_API_KEY'),
            ])->json();

            if(!empty($geo['results'])) {
                return [
                    'latitude' => $geo['results'][0]['geometry']['location']['lat'],
                    'longitude' => $geo['results'][0]['geometry']['location']['lng'],
                ];
            }
            

            // Por enquanto retorna null se não tiver API
            return null;
        }

        return null; // se o CEP não for válido
    }
}