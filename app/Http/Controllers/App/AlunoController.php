<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\cadastro\Academia; // Verifique se o 'A' é maiúsculo no arquivo
use App\Models\cadastro\Personal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // Para a requisição da API

class AlunoController extends Controller
{
    public function index()
    {
        return view('cliente.index');
    }

    public function buscarProximos(Request $request)
    {
        $request->validate(['cep' => 'required']);
        $cep = preg_replace('/[^0-9]/', '', $request->cep);

        // 1. Converter CEP em Coordenadas (Usando OpenStreetMap/Nominatim)
        $response = Http::withHeaders(['User-Agent' => 'MinhaAppFitness'])
            ->get("https://nominatim.openstreetmap.org/search?format=json&postalcode=$cep&country=Brazil");

        if ($response->failed() || empty($response->json())) {
            return back()->withErrors(['cep' => 'Não foi possível localizar este CEP.']);
        }

        $minhaLat = $response->json()[0]['lat'];
        $minhaLng = $response->json()[0]['lon'];

        // 2. Raio de busca em KM (ex: 15km)
        $raio = 15;

        // 3. Query com a fórmula de Haversine para Academias
        $academias = Academia::selectRaw("*, (6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS distancia", [$minhaLat, $minhaLng, $minhaLat])
            ->having('distancia', '<', $raio)
            ->orderBy('distancia')
            ->get();

        // 4. Query para Personais
        $personals = Personal::selectRaw("*, (6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS distancia", [$minhaLat, $minhaLng, $minhaLat])
            ->having('distancia', '<', $raio)
            ->orderBy('distancia')
            ->get();

        return view('cliente.resultados', compact('academias', 'personals', 'cep'));
    }
}