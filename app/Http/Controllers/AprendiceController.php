<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class AprendiceController extends Controller
{
    private function fetchDataFromApi($url)
    {
        $response = Http::get($url);
        return $response->json();
    }

    public function index()
    {
        $url = env('URL_SERVER_API');
        $aprendices = $this->fetchDataFromApi($url . '/aprendices') ?? [];

        return view('aprendice.index', compact('aprendices'));
    }

    private function findAprendice($id)
    {
        $url = env('URL_SERVER_API');
        $aprendices = $this->fetchDataFromApi($url . '/aprendices') ?? [];

        return collect($aprendices)->firstWhere('id', (int) $id);
    }

    public function show($id)
    {
        $aprendice = $this->findAprendice($id);

        return view('aprendice.show', compact('aprendice'));
    }

    public function create()
    {
        $url = env('URL_SERVER_API');
        
        // Buscamos cursos probando en español e inglés por seguridad
        $courses = $this->fetchDataFromApi($url . '/cursos');
        if (empty($courses)) {
            $courses = $this->fetchDataFromApi($url . '/courses');
        }
        $courses = $courses ?? [];

        // Buscamos computadores probando en inglés y español
        $computers = $this->fetchDataFromApi($url . '/computers');
        if (empty($computers)) {
            $computers = $this->fetchDataFromApi($url . '/computadores');
        }
        $computers = $computers ?? [];

        return view('aprendice.create', compact('courses', 'computers'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'cell_number' => 'required|string|max:20',
            'course_id' => 'required|integer',
            'computer_id' => 'required|integer',
        ]);

        $url = env('URL_SERVER_API');
        Http::post($url . '/aprendices', $data);

        return redirect()->route('aprendice.list');
    }

    public function edit($id)
    {
        $aprendice = $this->findAprendice($id);
        $url = env('URL_SERVER_API');
        
        $courses = $this->fetchDataFromApi($url . '/cursos');
        if (empty($courses)) {
            $courses = $this->fetchDataFromApi($url . '/courses');
        }
        $courses = $courses ?? [];

        $computers = $this->fetchDataFromApi($url . '/computers');
        if (empty($computers)) {
            $computers = $this->fetchDataFromApi($url . '/computadores');
        }
        $computers = $computers ?? [];

        return view('aprendice.edit', compact('aprendice', 'courses', 'computers'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'cell_number' => 'required|string|max:20',
            'course_id' => 'required|integer',
            'computer_id' => 'required|integer',
        ]);

        $url = env('URL_SERVER_API');
        Http::put($url . '/aprendices/' . $id, $data);

        return redirect()->route('aprendice.list');
    }

    public function destroy($id)
    {
        $url = env('URL_SERVER_API');
        Http::delete($url . '/aprendices/' . $id);

        return redirect()->route('aprendice.list');
    }
}