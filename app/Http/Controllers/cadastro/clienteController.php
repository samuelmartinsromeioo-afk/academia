<?php

namespace App\Http\Controllers\cadastro;


use App\Http\Controllers\Controller;
use App\Models\cadastro\Cliente;
use Illuminate\Support\Facades\Http;
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

        // 🔎 buscar coordenadas
        $coords = $this->buscarCoordenadas($validated['cep']);

        if ($coords) {
            $validated['latitude'] = $coords['latitude'];
            $validated['longitude'] = $coords['longitude'];
        }


        Cliente::create($validated);

        return redirect()->route('login.index')
       ->with('success', 'Cliente cadastrado com sucesso!');
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
