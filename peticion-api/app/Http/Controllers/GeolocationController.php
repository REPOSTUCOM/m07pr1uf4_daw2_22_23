<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class GeolocationController extends Controller
{
    public function getGeolocation(Request $request)
    {
         // Verifica si se proporcionó un token válido en la solicitud
         $token = $request->bearerToken();

         if (!$token) {
             return response()->json(['error' => 'Unauthorized Invalid Token'], 401);
         }
         
        $apiKey = "90b4c23c47a142d29692d7ecaedb65bf"; // Reemplaza "YOUR_API_KEY" con tu clave de API

        $city = $request->city();

        $client = new Client();
        $response = $client->get("https://ipgeolocation.abstractapi.com/v1/?api_key=$apiKey&city=$city");
        $data = json_decode($response->getBody(), true);

        // Procesa y devuelve los datos de geolocalización
        return response()->json($data);
    }
}