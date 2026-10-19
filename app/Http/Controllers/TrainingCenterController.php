<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class TrainingCenterController extends Controller
{
    private function fetchDataFromApi($url)
    {
        $response = Http::get($url);
        return $response->json();
    }

    // Método auxiliar para probar múltiples rutas posibles en la API
    private function getCentersFromApi()
    {
        $url = env('URL_SERVER_API');
        $possibleRoutes = ['/centros', '/centers', '/training-centers', '/training_centers', '/centros-formacion'];

        foreach ($possibleRoutes as $route) {
            $data = $this->fetchDataFromApi($url . $route);
            if (!empty($data) && is_array($data)) {
                return $data;
            }
        }

        return [];
    }

    public function index()
    {
        $centers = $this->getCentersFromApi();

        return view('training_center.index', compact('centers'));
    }

    public function show($id)
    {
        $url = env('URL_SERVER_API');
        $possibleRoutes = ['/centros/', '/centers/', '/training-centers/', '/training_centers/', '/centros-formacion/'];
        
        $center = null;
        foreach ($possibleRoutes as $route) {
            $data = $this->fetchDataFromApi($url . $route . $id);
            if (!empty($data)) {
                $center = $data;
                break;
            }
        }

        return view('training_center.show', compact('center'));
    }

    public function create()
    {
        return view('training_center.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ]);

        $url = env('URL_SERVER_API');
        $possibleRoutes = ['/centros', '/centers', '/training-centers', '/training_centers', '/centros-formacion'];

        foreach ($possibleRoutes as $route) {
            $response = Http::post($url . $route, $data);
            if ($response->successful()) {
                break;
            }
        }

        return redirect()->route('training_center.list');
    }

    public function edit($id)
    {
        $url = env('URL_SERVER_API');
        $possibleRoutes = ['/centros/', '/centers/', '/training-centers/', '/training_centers/', '/centros-formacion/'];
        
        $center = null;
        foreach ($possibleRoutes as $route) {
            $data = $this->fetchDataFromApi($url . $route . $id);
            if (!empty($data)) {
                $center = $data;
                break;
            }
        }

        return view('training_center.edit', compact('center'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ]);

        $url = env('URL_SERVER_API');
        $possibleRoutes = ['/centros/', '/centers/', '/training-centers/', '/training_centers/', '/centros-formacion/'];

        foreach ($possibleRoutes as $route) {
            $response = Http::put($url . $route . $id, $data);
            if ($response->successful()) {
                break;
            }
        }

        return redirect()->route('training_center.list');
    }

    public function destroy($id)
    {
        $url = env('URL_SERVER_API');
        $possibleRoutes = ['/centros/', '/centers/', '/training-centers/', '/training_centers/', '/centros-formacion/'];

        foreach ($possibleRoutes as $route) {
            $response = Http::delete($url . $route . $id);
            if ($response->successful()) {
                break;
            }
        }

        return redirect()->route('training_center.list');
    }
}