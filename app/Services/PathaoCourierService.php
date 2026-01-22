<?php

namespace App\Services;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


class PathaoCourierService
{
    protected $baseUrl;
    protected $clientId;
    protected $clientSecret;
    protected $username;
    protected $password;
    protected $token;

    public function __construct()
    {
        $this->baseUrl = env('PATHAO_BASE_URL');
        $this->clientId = env('PATHAO_CLIENT_ID');
        $this->clientSecret = env('PATHAO_CLIENT_SECRET');
        $this->username = env('PATHAO_USERNAME');
        $this->password = env('PATHAO_PASSWORD');

        $this->token = $this->getAccessToken();
    }

    // Get Access Token
    public function getAccessToken()
    {
        $response = Http::post("{$this->baseUrl}/aladdin/api/v1/issue-token", [
            "client_id" => $this->clientId,
            "client_secret" => $this->clientSecret,
            "grant_type" => "password",
            "username" => $this->username,
            "password" => $this->password,
        ]);

        if ($response->successful()) {
            return $response->json('access_token');
        }

        return null;
    }

    // Fetch Cities from Pathao API
    public function getCities()
    {
        if (!$this->token) {
            return ['error' => 'Failed to get access token'];
        }

        try {
            $response = Http::withToken($this->token)->get("{$this->baseUrl}/aladdin/api/v1/city-list");

            if ($response->successful()) {
                return $response->json()['data']['data']; // Returns city list
            }

            // Log error response
            Log::error('Pathao API Cities Error', ['response' => $response->json()]);
            return [];
        } catch (\Exception $e) {
            Log::error('Error while fetching cities', ['exception' => $e->getMessage()]);
            return [];
        }
    }

    // Get City ID by City Name
    public function getCityId($cityName)
    {
        $cities = $this->getCities();

        foreach ($cities as $city) {
            if (strcasecmp($city['city_name'], $cityName) == 0) {
                return $city['city_id']; // Return city ID
            }
        }

        return 1; // Default to Dhaka if city not found
    }

    // Fetch Zones in a City
    public function getZones($cityId)
    {
        if (!$this->token) {
            return [];
        }

        try {
            $response = Http::withToken($this->token)->get("{$this->baseUrl}/aladdin/api/v1/cities/{$cityId}/zone-list");

            if ($response->successful()) {
                return $response->json()['data']['data'];
            }

            // Log error response
            Log::error('Pathao API Zones Error', ['response' => $response->json()]);
            return [];
        } catch (\Exception $e) {
            Log::error('Error while fetching zones', ['exception' => $e->getMessage()]);
            return [];
        }
    }

    // Get Zone ID by Zone Name
    public function getZoneId($cityId, $zoneName)
    {
        $zones = $this->getZones($cityId);

        foreach ($zones as $zone) {
            if (strcasecmp($zone['zone_name'], $zoneName) == 0) {
                return $zone['zone_id'];
            }
        }

        return 10; // Default Zone
    }

    // Fetch Areas in a Zone
    public function getAreas($zoneId)
    {
        if (!$this->token) {
            return [];
        }

        try {
            $response = Http::withToken($this->token)->get("{$this->baseUrl}/aladdin/api/v1/zones/{$zoneId}/area-list");

            if ($response->successful()) {
                return $response->json()['data']['data'];
            }

            // Log error response
            Log::error('Pathao API Areas Error', ['response' => $response->json()]);
            return [];
        } catch (\Exception $e) {
            Log::error('Error while fetching areas', ['exception' => $e->getMessage()]);
            return [];
        }
    }

    // Get Area ID by Area Name
    public function getAreaId($zoneId, $areaName)
    {
        $areas = $this->getAreas($zoneId);

        foreach ($areas as $area) {
            if (strcasecmp($area['area_name'], $areaName) == 0) {
                return $area['area_id'];
            }
        }

        return 100; // Default Area
    }


// Create Order
    public function createOrder($orderData)
    {
        if (!$this->token) {
            return ['error' => 'Failed to get access token'];
        }

        try {
            $response = Http::withToken($this->token)->post("{$this->baseUrl}/aladdin/api/v1/orders", $orderData);

            if ($response->successful()) {
                return $response->json();
            }

            // Log error response
            Log::error('Pathao API Order Creation Error', ['response' => $response->json()]);
            return $response->json();
        } catch (\Exception $e) {
            Log::error('Error while creating order', ['exception' => $e->getMessage()]);
            return ['error' => $e->getMessage()];
        }
    }
}
