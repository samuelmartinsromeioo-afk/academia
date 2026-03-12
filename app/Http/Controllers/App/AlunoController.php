<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\cadastro\Academia;
use App\Models\cadastro\Cliente;
use App\Models\cadastro\Personal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class AlunoController extends Controller
{
    public function index()
    {
        return view('cliente.index');
    }

    public function buscarAcademias()
    {
        $coords = $this->obterCoordsClienteLogado();
        if (!$coords) {
            return back()->withErrors(['cep' => 'Não conseguimos localizar seu CEP de cadastro.']);
        }

        $academias = Academia::all();
        $academiasProximas = $this->buscarPorProximidade($academias, $coords, 15);

        return view('cliente.resultados', [
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

        return view('cliente.resultados', [
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