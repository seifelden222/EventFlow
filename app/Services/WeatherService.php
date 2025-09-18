<?php

namespace App\Services;

use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\RateLimiter;
use \Illuminate\Support\Str;

class WeatherService
{
    protected $apiKey;
    protected $baseUrl;
    protected $temb=null;
    protected $description="";
    public function __construct()
    {
        $this->apiKey = config('services.weather.api_key');
        $this->baseUrl = 'https://api.openweathermap.org/data/2.5/';
    }
    public function currentByCoords(float $lat, float $lon, int $ttl = 300, string $units = 'metric', ?string $lang = null, $temb = null, $description = null)
    {
        $cacheKey = "weather_cache_{$lat}_{$lon}";
        $attemptKey = "weather_attempt_{$lat}_{$lon}";

        try {
            RateLimiter::attempt($attemptKey, 60, function () {
                return true;
            }, 60);
            if (RateLimiter::tooManyAttempts($attemptKey, 60)) {
                return ['error' => 'Rate limit exceeded. Please try again later.'];
            }

            $request = Cache::remember($cacheKey, $ttl, function () use ($lat, $lon, $units, $lang,$temb,$description) {
                return Http::timeout(10)
                    ->retry(3, 200)
                    ->get("{$this->baseUrl}weather", [
                        'lat' => $lat,
                        'lon' => $lon,
                        'appid' => $this->apiKey,
                        'units' => $units,
                        'temp' => (float)$temb,
                        'description' => $description,
                        'lang' => $lang,
                    ])->throw()->json();
            });

            return $this->formatCurrentWeather($request, "{$lat},{$lon}");
        } catch (RequestException  $e) {
            return ['error' => 'Failed to fetch weather data: ' . $e->getMessage()];
        } catch (\Throwable $e) {
            return ['error' => 'Failed to fetch weather data: ' . $e->getMessage()];
        }
    }


    public function currentByCity(string $city, int $ttl = 300, string $units = 'metric', ?string $lang = null, $temb = null, $description = null)
    {

        $city_key = Str::lower($city);
        $cacheKey = "wx_current_city_cache_{$city_key}";
        $attemptKey = "wx_current_city_attempt_{$city_key}";

        if (empty($this->apiKey)) {
            return ['error' => 'Weather API key not configured'];
        }

        try {
            RateLimiter::attempt($attemptKey, 60, function () {
                return true;
            }, 60);
            if (RateLimiter::tooManyAttempts($attemptKey, 60)) {
                return ['error' => 'Rate limit exceeded. Please try again later.'];
            }
            $request = Cache::remember($cacheKey, $ttl, function () use ($city, $units, $lang,$temb,$description) {
                return Http::timeout(10)
                    ->retry(3, 200)
                    ->get("{$this->baseUrl}weather", [
                        'q' => $city,
                        'appid' => $this->apiKey,
                        'units' => $units,
                        'temb' => (float)$temb,
                        'description' => $description,
                        'lang' => $lang,
                    ])->throw()->json();
            });

            return $this->formatCurrentWeather($request, $city);
        } catch (RequestException  $e) {
            return ['error' => 'Failed to fetch weather data: ' . $e->getMessage()];
        } catch (\Throwable $e) {
            return ['error' => 'Failed to fetch weather data: ' . $e->getMessage()];
        }
    }

    public function formatCurrentWeather($response, string $city): array
    {
        // If we didn't get a parsed JSON object/array, return a clear error
        if (!is_array($response)) {
            return [
                'error' => 'Invalid weather service response',
                'raw' => $response,
            ];
        }

        return [
            'city'        => $response['name'] ?? $city,
            'country'     => $response['sys']['country'] ?? null,
            'temp'        => $response['main']['temp'] ?? null,
            'feels_like'  => $response['main']['feels_like'] ?? null,
            'humidity'    => $response['main']['humidity'] ?? null,
            'wind_speed'  => $response['wind']['speed'] ?? null,
            'description' => $response['weather'][0]['description'] ?? null,
            'icon'        => $response['weather'][0]['icon'] ?? null,
            'sunrise'     => isset($response['sys']['sunrise']) ? date('H:i', $response['sys']['sunrise']) : null,
            'sunset'      => isset($response['sys']['sunset']) ? date('H:i', $response['sys']['sunset']) : null,
            'timestamp'   => $response['dt'] ?? time(),
        ];
    }
}
