<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\WeatherService;
use Illuminate\Http\Request;

class WeatherApiController extends Controller
{
 

    public function currentByCoords(Request $request, WeatherService $weatherService)
    {
        try {


            $request->validate([
                'lat' => ['required', 'numeric', 'between:-90,90'],
                'lon' => ['required', 'numeric', 'between:-180,180'],
                'units' => ['nullable', 'in:metric,imperial'],
                'lang' => ['nullable', 'string', 'max:5'],
            ]);

            $data = $request->only(['lat', 'lon', 'units', 'lang']);

            $weatherData = $weatherService->currentByCoords(
                (float) $data['lat'],
                (float) $data['lon'],
                300,
                $data['units'] ?? 'metric',
                $data['lang'] ?? null,
                $data['temb'] ?? null,
                $data['description'] ?? null,
            );

            return response()->json($weatherData);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to retrieve weather data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function currentWeatherByCity(Request $request, WeatherService $weatherService)
    {

        try{ 
        $request->validate([
            'city' => 'required|string|max:255',
            'units' => ['nullable', 'in:metric,imperial'],
            'lang' => ['nullable', 'string', 'max:5'],
        ]);

        $data = $request->only(['city', 'units', 'lang']);

        $weatherData = $weatherService->currentByCity(
            $data['city'],
            300,
            $data['units'] ?? 'metric',
            $data['lang'] ?? null,
            $data['temb'] ?? null,
            $data['description'] ?? null
        );

        return response()->json($weatherData);
    }catch (\Exception $e) {
        return response()->json([
            'message' => 'Failed to retrieve weather data',
            'error' => $e->getMessage()
        ], 500);
    }
}
}
