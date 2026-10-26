<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class ComputerController extends Controller
{
    private function fetchDataFromApi($url)
    {
        $response = Http::get($url);
        return $response->json();
    }
    
    public function index()
    {
        $url = env('URL_SERVER_API');
        $computers = $this->fetchDataFromApi($url . '/computers');

        return view('computer.index', compact('computers'));
    }

    public function show($id)
    {
        $url = env('URL_SERVER_API');
        $computer = $this->fetchDataFromApi($url . '/computers/' . $id);

        return view('computer.show', compact('computer'));
    }

    public function create()
    {
        return view('computer.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'number' => 'required|integer',
            'brand' => 'required|string|max:255',
            'urlFoto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
        ]);

        $url = env('URL_SERVER_API') . '/computers';
        
        $http = Http::asMultipart();

        if ($request->hasFile('urlFoto')) {
            $file = $request->file('urlFoto');
            $http->attach('urlFoto', file_get_contents($file->getRealPath()), $file->getClientOriginalName());
        }

        $http->post($url, [
            'number' => $request->number,
            'brand' => $request->brand,
        ]);

        return redirect()->route('computer.list');
    }

    public function edit($id)
    {
        $url = env('URL_SERVER_API');
        $computer = $this->fetchDataFromApi($url . '/computers/' . $id);

        return view('computer.edit', compact('computer'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'number' => 'required|integer',
            'brand' => 'required|string|max:255',
            'urlFoto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
        ]);

        $url = env('URL_SERVER_API') . '/computers/' . $id;

        $http = Http::asMultipart();

        if ($request->hasFile('urlFoto')) {
            $file = $request->file('urlFoto');
            $http->attach('urlFoto', file_get_contents($file->getRealPath()), $file->getClientOriginalName());
        }

        // Nota: Laravel/Symfony a veces requiere un campo _method='PUT' al enviar archivos por POST con multipart
        $http->post($url, [
            '_method' => 'PUT',
            'number' => $request->number,
            'brand' => $request->brand,
        ]);

        return redirect()->route('computer.list');
    }

    public function destroy($id)
    {
        $url = env('URL_SERVER_API');
        Http::delete($url . '/computers/' . $id);

        return redirect()->route('computer.list');
    }
}