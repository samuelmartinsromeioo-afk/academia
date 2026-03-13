<?php

namespace App\Http\Controllers\cadastro;


use App\Http\Controllers\Controller;
use App\Models\cadastro\Cliente;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\cadastro\Academia;
use App\Models\cadastro\Personal;
use Illuminate\Support\Facades\Auth;


class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // No seu Controller
    public function index() 
    {
        $coords = $this->obterCoordsClienteLogado();
        $personaisProximos = [];

        if ($coords) {
            $personais = Personal::all();
            $personaisProximos = $this->buscarPorProximidade($personais, $coords, 15);
        }

        // A VIEW ESPERA $academias, ENTÃO ENVIE COM ESSE NOME
        return view('cliente.index', [
            'academias' => $personaisProximos, 
            'distancia_referencia' => '15km'
        ]);
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
     * Buscar coordenadas (latitude e longitude) a partir do CEP.
     */
    
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
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:clientes,email,' . $cliente->id,
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

        Cliente::update($validated);

        return redirect()->route('cliente.index')
        ->with('success', 'Perfil mudado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        //
    }

    public function buscarAcademias()
    {
        $coords = $this->obterCoordsClienteLogado();
        if (!$coords) {
            return back()->withErrors(['cep' => 'Não conseguimos localizar seu CEP de cadastro.']);
        }

        $academias = Academia::all();
        $academiasProximas = $this->buscarPorProximidade($academias, $coords, 15);

        return view('cliente.buscarAcademia', [
            'academias' => $academiasProximas,
            'distancia_referencia' => '15km'
        ]);
    }

    public function buscarPersonal()
    {
        $coords = $this->obterCoordsClienteLogado();
        if (!$coords) {
            return back()->withErrors(['cep' => 'Não conseguimos localizar seu CEP de cadastro.']);
        }

        $personais = Personal::all();
        $personaisProximos = $this->buscarPorProximidade($personais, $coords, 15);

        return view('cliente.buscarPersonal', [
            'academias' => $personaisProximos,
            'distancia_referencia' => '15km'
        ]);
    }

    private function obterCoordsClienteLogado()
    {
        $cliente = Cliente::find(Auth::id());
        if (!$cliente || empty($cliente->cep)) return null;

        $cepLimpo = preg_replace('/[^0-9]/', '', $cliente->cep);
        return $this->getLatLngFromCepAwesomeApi($cepLimpo);
    }

    private function buscarPorProximidade($collection, $coords, $raio)
    {
        $lat = $coords['lat'];
        $lng = $coords['lng'];

        // Filtro de Bounding Box para performance
        $latDelta = $raio / 111;
        $lngDelta = $raio / (111 * cos(deg2rad($lat)));

        return $collection->filter(function ($item) use ($lat, $lng, $latDelta, $lngDelta, $raio) {
            if (!isset($item->latitude, $item->longitude)) return false;

            if ($item->latitude < ($lat - $latDelta) || $item->latitude > ($lat + $latDelta)) return false;
            if ($item->longitude < ($lng - $lngDelta) || $item->longitude > ($lng + $lngDelta)) return false;

            // Calcula distância haversine
            $distancia = $this->haversine($lat, $lng, $item->latitude, $item->longitude);
            return $distancia <= $raio;
        })->sortBy(function ($item) use ($lat, $lng) {
            return $this->haversine($lat, $lng, $item->latitude, $item->longitude);
        })->values();
    }

    private function haversine($lat1, $lng1, $lat2, $lng2)
    {
        $earthRadius = 6371; // km
        $dLat = deg2rad($lat2 - $lat1);
        $dLng = deg2rad($lng2 - $lng1);

        $a = sin($dLat/2) * sin($dLat/2) +
             cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
             sin($dLng/2) * sin($dLng/2);

        $c = 2 * atan2(sqrt($a), sqrt(1-$a));
        return $earthRadius * $c;
    }

    private function getLatLngFromCepAwesomeApi($cep)
    {
        $response = Http::get("https://cep.awesomeapi.com.br/json/{$cep}");
        if ($response->failed() || empty($response->json())) return null;

        $data = $response->json();
        // A AwesomeAPI retorna 'lat' e 'lng' como string
        if (!isset($data['lat'], $data['lng'])) return null;

        return [
            'lat' => (float) $data['lat'],
            'lng' => (float) $data['lng']
        ];
    }
}
