<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    private function fetchDataFromApi($url)
    {
        $response = Http::get($url);
        return $response->json();
    }

    public function index()
    {
        $url = env('URL_SERVER_API');
        $cursos = $this->fetchDataFromApi($url . '/cursos');
        if (empty($cursos)) {
            $cursos = $this->fetchDataFromApi($url . '/courses');
        }
        $cursos = $cursos ?? [];

        return view('course.index', compact('cursos'));
    }

    public function show($id)
    {
        $url = env('URL_SERVER_API');
        $curso = $this->fetchDataFromApi($url . '/cursos/' . $id);
        if (empty($curso)) {
            $curso = $this->fetchDataFromApi($url . '/courses/' . $id);
        }

        return view('course.show', compact('curso'));
    }

    public function create()
    {
        $url = env('URL_SERVER_API');
        
        $areas = $this->fetchDataFromApi($url . '/areas') ?? [];
        
        // Buscamos los centros de formación probando ambas rutas (español e inglés)
        $training_centers = $this->fetchDataFromApi($url . '/centros');
        if (empty($training_centers)) {
            $training_centers = $this->fetchDataFromApi($url . '/centers');
        }
        $training_centers = $training_centers ?? [];

        return view('course.create', compact('areas', 'training_centers'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'course_number' => 'required|integer',
            'day' => 'required|string|max:50',
            'area_id' => 'required|integer',
            'training_center_id' => 'required|integer',
        ]);

        $url = env('URL_SERVER_API');
        $response = Http::post($url . '/cursos', $data);
        if ($response->failed()) {
            Http::post($url . '/courses', $data);
        }

        return redirect()->route('course.list');
    }

    public function edit($id)
    {
        $url = env('URL_SERVER_API');
        $curso = $this->fetchDataFromApi($url . '/cursos/' . $id);
        if (empty($curso)) {
            $curso = $this->fetchDataFromApi($url . '/courses/' . $id);
        }

        $areas = $this->fetchDataFromApi($url . '/areas') ?? [];
        
        $training_centers = $this->fetchDataFromApi($url . '/centros');
        if (empty($training_centers)) {
            $training_centers = $this->fetchDataFromApi($url . '/centers');
        }
        $training_centers = $training_centers ?? [];

        return view('course.edit', compact('curso', 'areas', 'training_centers'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'course_number' => 'required|integer',
            'day' => 'required|string|max:50',
            'area_id' => 'required|integer',
            'training_center_id' => 'required|integer',
        ]);

        $url = env('URL_SERVER_API');
        $response = Http::put($url . '/cursos/' . $id, $data);
        if ($response->failed()) {
            Http::put($url . '/courses/' . $id, $data);
        }

        return redirect()->route('course.list');
    }

    public function destroy($id)
    {
        $url = env('URL_SERVER_API');
        $response = Http::delete($url . '/cursos/' . $id);
        if ($response->failed()) {
            Http::delete($url . '/courses/' . $id);
        }

        return redirect()->route('course.list');
    }
}