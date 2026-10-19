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
        $data = $request->validate([
            'number' => 'required|integer',
            'brand' => 'required|string|max:255',
            'urlFoto' => 'nullable|image|max:2048',
        ]);

        unset($data['urlFoto']);
        $url = env('URL_SERVER_API') . '/computers';

        if ($request->hasFile('urlFoto')) {
            $file = $request->file('urlFoto');
            Http::attach('urlFoto', file_get_contents($file->getRealPath()), $file->getClientOriginalName())
                ->post($url, $data);
        } else {
            Http::post($url, $data);
        }

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
        $data = $request->validate([
            'number' => 'required|integer',
            'brand' => 'required|string|max:255',
            'urlFoto' => 'nullable|image|max:2048',
        ]);

        unset($data['urlFoto']);
        $url = env('URL_SERVER_API') . '/computers/' . $id;

        if ($request->hasFile('urlFoto')) {
            $file = $request->file('urlFoto');
            Http::attach('urlFoto', file_get_contents($file->getRealPath()), $file->getClientOriginalName())
                ->put($url, $data);
        } else {
            Http::put($url, $data);
        }

        return redirect()->route('computer.list');
    }

    public function destroy($id)
    {
        $url = env('URL_SERVER_API');
        Http::delete($url . '/computers/' . $id);

        return redirect()->route('computer.list');
    }
}