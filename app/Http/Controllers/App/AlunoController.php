<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\cadastro\Academia; // Verifique se o 'A' é maiúsculo no arquivo
use App\Models\cadastro\Cliente;
use App\Models\cadastro\Personal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; // Para a requisição da API

class AlunoController extends Controller
{
    public function index()
    {
        return view('cliente.index');
    }

    

    public function buscarAcademias(Request $request)
    {
        // 1️⃣ Validar CEP
        $request->validate([
            'cep' => 'required'
        ]);

        // 2️⃣ Limpar CEP
        $cep = preg_replace('/[^0-9]/', '', $request->cep);

        // 3️⃣ Buscar coordenadas do CEP
        $response = Http::withHeaders([
            'User-Agent' => 'MinhaAppFitness'
        ])->get("https://nominatim.openstreetmap.org/search", [
            'format' => 'json',
            'postalcode' => $cep,
            'country' => 'Brazil'
        ]);

        if ($response->failed() || empty($response->json())) {
            return back()->withErrors([
                'cep' => 'Não foi possível localizar este CEP.'
            ]);
        }

        // 4️⃣ Pegando latitude e longitude
        $minhaLat = $response->json()[0]['lat'];
        $minhaLng = $response->json()[0]['lon'];

        // 5️⃣ Raio de busca (km)
        $raio = 15;

        // 6️⃣ Bounding Box (filtro rápido)
        $latDelta = $raio / 111;
        $lngDelta = $raio / (111 * cos(deg2rad($minhaLat)));

        $minLat = $minhaLat - $latDelta;
        $maxLat = $minhaLat + $latDelta;
        $minLng = $minhaLng - $lngDelta;
        $maxLng = $minhaLng + $lngDelta;

        // 7️⃣ Query com Haversine
        $academias = Academia::whereBetween('latitude', [$minLat, $maxLat])
            ->whereBetween('longitude', [$minLng, $maxLng])
            ->selectRaw(
                "*, (6371 * acos(
                    cos(radians(?)) *
                    cos(radians(latitude)) *
                    cos(radians(longitude) - radians(?)) +
                    sin(radians(?)) *
                    sin(radians(latitude))
                )) AS distancia",
                [$minhaLat, $minhaLng, $minhaLat]
            )
            ->having('distancia', '<', $raio)
            ->orderBy('distancia')
            ->get();

        // 8️⃣ Retornar view
        return view('cliente.resultados', [
            'academias' => $academias,
            'cep' => $cep
        ]);
    }
    public function buscarPersonal(Request $request)
    {
        // validar CEP
        $request->validate([
            'cep' => 'required'
        ]);

        // limpar CEP
        $cep = preg_replace('/[^0-9]/', '', $request->cep);

        // buscar coordenadas
        $response = Http::withHeaders([
            'User-Agent' => 'MinhaAppFitness'
        ])->get("https://nominatim.openstreetmap.org/search", [
            'format' => 'json',
            'postalcode' => $cep,
            'country' => 'Brazil'
        ]);

        if ($response->failed() || empty($response->json())) {
            return back()->withErrors([
                'cep' => 'Não foi possível localizar este CEP.'
            ]);
        }

        // coordenadas do usuário
        $minhaLat = $response->json()[0]['lat'];
        $minhaLng = $response->json()[0]['lon'];

        // raio de busca
        $raio = 15;

        // bounding box (filtro rápido)
        $latDelta = $raio / 111;
        $lngDelta = $raio / (111 * cos(deg2rad($minhaLat)));

        $minLat = $minhaLat - $latDelta;
        $maxLat = $minhaLat + $latDelta;
        $minLng = $minhaLng - $lngDelta;
        $maxLng = $minhaLng + $lngDelta;

        // buscar personals
        $personals = Personal::whereBetween('latitude', [$minLat, $maxLat])
            ->whereBetween('longitude', [$minLng, $maxLng])
            ->selectRaw(
                "*, (6371 * acos(
                    cos(radians(?)) *
                    cos(radians(latitude)) *
                    cos(radians(longitude) - radians(?)) +
                    sin(radians(?)) *
                    sin(radians(latitude))
                )) AS distancia",
                [$minhaLat, $minhaLng, $minhaLat]
            )
            ->having('distancia', '<', $raio)
            ->orderBy('distancia')
            ->get();

        return view('cliente.resultados_personal', [
            'personals' => $personals,
            'cep' => $cep
        ]);
    }


}