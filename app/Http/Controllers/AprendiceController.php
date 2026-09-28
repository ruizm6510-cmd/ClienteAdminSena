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
        $aprendices = $this->fetchDataFromApi($url . '/aprendices');

        return view('aprendice.index', compact('aprendices'));
    }
}
