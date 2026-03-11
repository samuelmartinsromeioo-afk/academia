<?php

namespace App\Http\Controllers\Cadastro;
use App\Http\Controllers\Controller; 
use App\Models\cadastro\Academia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class AcademiaController extends Controller
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
        // Certifique-se que a view está em resources/views/cadastros/personal.blade.php
        return view('cadastro.academia');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dados=$request->validate([
        'nome'=>'required|string|max:255',
        'cep'=>'required|string|max:8',
        'rua'=>'required|string|max:300',
        'bairro'=>'required|string|max:200',
        'cidade'=>'required|string|max:200',
        'estado'=>'required|string|max:200',
        'complemento'=>'required|string|min:1',
        'endereco'=>'required|string|max:255',
        'valor_mensalidade'=>'required|numeric|min:0',
        'descricao'=>'nullable|string|max:255',
        'senha'=>'required|string|min:8|confirmed',
        'cnpj'=>'required|string|unique:academias,cnpj|max:18',
        'infraestrutura'=>'required|string|max:255',
        'tipos_aulas'=>'required|string|max:255'
        ]);
        
        $dados['senha'] = bcrypt($dados['senha']);
        // 🔎 buscar coordenadas
        $coords = $this->buscarCoordenadas($dados['cep']);

        if ($coords) {
            $dados['latitude'] = $coords['latitude'];
            $dados['longitude'] = $coords['longitude'];
        }

        Academia::create($dados);
        return redirect()->route('form.academia')->with('sucesso', 'Personal cadastrado com sucesso!');
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
