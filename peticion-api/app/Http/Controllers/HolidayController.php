<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class HolidayController extends Controller
{
    public function getHolidays(Request $request)
    {
          // Verifica si se proporcionó un token válido en la solicitud
          $token = $request->bearerToken();

          if (!$token) {
              return response()->json(['error' => 'Unauthorized Invalid Token'], 401);
          }

        $apiKey = 'a470ca47-0850-4b17-bedb-d9db5cfb7fb5'; // Reemplaza esto con tu clave de API de HolidayAPI

        $client = new Client([
            'verify' => false, // Desactivar la verificación del certificado SSL
        ]);

        try {
            $response = $client->get("https://api.holidayapi.com/v1/holidays", [
                'query' => [
                    'key' => $apiKey,
                    'country' => $request->input('country'),
                    'year' => $request->input('year'),
                ]
            ]);

            $data = json_decode($response->getBody(), true);

            // Procesa y devuelve los datos de las vacaciones
            return response()->json($data);
        } catch (GuzzleException $e) {
            // Maneja el error de Guzzle
            // Puedes mostrar un mensaje de error o realizar otra acción apropiada
            return response()->json(['error' => 'Error al realizar la solicitud a la API'], 500);
        }
    }

    public function getCountries()
    {
          // Verifica si se proporcionó un token válido en la solicitud
          $token = $request->bearerToken();

          if (!$token) {
              return response()->json(['error' => 'Unauthorized Invalid Token'], 401);
          }
        $apiKey = 'a470ca47-0850-4b17-bedb-d9db5cfb7fb5'; // Reemplaza esto con tu clave de API de HolidayAPI

        $client = new Client();

        try {
            $response = $client->get("https://holidayapi.com/v1/countries", [
                'query' => [
                    'pretty' => true,
                    'key' => $apiKey,
                ]
            ]);

            $data = json_decode($response->getBody(), true);

            // Procesa y devuelve los datos de los países
            return response()->json($data);
        } catch (GuzzleException $e) {
            // Maneja el error de Guzzle
            // Puedes mostrar un mensaje de error o realizar otra acción apropiada
            return response()->json(['error' => 'Error al realizar la solicitud a la API'], 500);
        }
    }

    public function getLanguages(Request $request)
    {
          // Verifica si se proporcionó un token válido en la solicitud
          $token = $request->bearerToken();

          if (!$token) {
              return response()->json(['error' => 'Unauthorized Invalid Token'], 401);
          }
        $client = new Client();
        $apiKey = 'a470ca47-0850-4b17-bedb-d9db5cfb7fb5';
        $url = 'https://holidayapi.com/v1/languages?pretty&key='.$apiKey;
        
        try {
            $response = $client->get($url);
            $data = json_decode($response->getBody(), true);
            
            // Procesa y devuelve los datos de los idiomas
            return response()->json($data);
        } catch (\Exception $e) {
            // Manejo de errores si la solicitud falla
            return response()->json(['error' => 'Error al obtener los idiomas'], 500);
        }
    }
    
    public function getWorkDay(Request $request)
    {
          // Verifica si se proporcionó un token válido en la solicitud
          $token = $request->bearerToken();

          if (!$token) {
              return response()->json(['error' => 'Unauthorized Invalid Token'], 401);
          }
        $client = new Client();
        $apiKey = 'a470ca47-0850-4b17-bedb-d9db5cfb7fb5';
        $country = $request->input('country');
        $start = $request->input('start');
        $days = $request->input('days');
        $url = 'https://holidayapi.com/v1/workday?pretty&key=' . $apiKey . '&country=' . $country . '&start=' . $start . '&days=' . $days;
        
        try {
            $response = $client->get($url);
            $data = json_decode($response->getBody(), true);
            
            // Procesa y devuelve los días laborables
            return response()->json($data);
        } catch (\Exception $e) {
            // Manejo de errores si la solicitud falla
            return response()->json(['error' => 'Error al obtener los días laborables'], 500);
        }
    }
}