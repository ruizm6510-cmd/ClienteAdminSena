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
    
    public function index()
    {
        $url = env('URL_SERVER_API');
        $centers = $this->fetchDataFromApi($url . '/training-centers');

        return $centers;
    }
}
