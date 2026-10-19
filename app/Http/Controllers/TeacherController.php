<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    private function fetchDataFromApi($url)
    {
        $response = Http::get($url);
        return $response->json();
    }

    public function index()
    {
        $url = env('URL_SERVER_API');

        $teachers = $this->fetchDataFromApi($url . '/teachers') ?? [];

        return view('teacher.index', compact('teachers'));
    }

    public function show($id)
    {
        $url = env('URL_SERVER_API');
        $teacher = $this->fetchDataFromApi($url . '/teachers/' . $id);

        return view('teacher.show', compact('teacher'));
    }

    public function create()
    {
        $url = env('URL_SERVER_API');
        $areas = $this->fetchDataFromApi($url . '/areas') ?? [];
        
        // Intentamos primero con '/centros', y si está vacío probamos con '/centers'
        $training_centers = $this->fetchDataFromApi($url . '/centros');
        if (empty($training_centers)) {
            $training_centers = $this->fetchDataFromApi($url . '/centers');
        }
        $training_centers = $training_centers ?? [];

        return view('teacher.create', compact('areas', 'training_centers'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'area_id' => 'required|integer',
            'training_center_id' => 'required|integer',
        ]);

        $url = env('URL_SERVER_API');
        Http::post($url . '/teachers', $data);

        return redirect()->route('teacher.list');
    }

    public function edit($id)
    {
        $url = env('URL_SERVER_API');
        $teacher = $this->fetchDataFromApi($url . '/teachers/' . $id);
        $areas = $this->fetchDataFromApi($url . '/areas') ?? [];
        
        $training_centers = $this->fetchDataFromApi($url . '/centros');
        if (empty($training_centers)) {
            $training_centers = $this->fetchDataFromApi($url . '/centers');
        }
        $training_centers = $training_centers ?? [];

        return view('teacher.edit', compact('teacher', 'areas', 'training_centers'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'area_id' => 'required|integer',
            'training_center_id' => 'required|integer',
        ]);

        $url = env('URL_SERVER_API');
        Http::put($url . '/teachers/' . $id, $data);

        return redirect()->route('teacher.list');
    }

    public function destroy($id)
    {
        $url = env('URL_SERVER_API');
        Http::delete($url . '/teachers/' . $id);

        return redirect()->route('teacher.list');
    }
}