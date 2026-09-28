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
}
