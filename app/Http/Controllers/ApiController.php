<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;


class ApiController extends Controller
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://nominatim.openstreetmap.org/',
        ]);
    }

    public function getLocation() {
        $country = 'US';
        $postalCode = '61000';
        $response = $this->client->get('search', [
            'query' => [
                'postalcode' => $postalCode,
                'country'    => $country,
                'format'     => 'json',
            ],
            'headers' => [
                'User-Agent' => 'Container' // Ensure this is specific to your app
            ]
        ]);
        $rlt = $response->getBody()->getContents();
        // dd($rlt['lon']);
    }

     // Reverse geocode to get address from coordinates
    public function reverseGeocode($lat, $lon)
    {
        $response = $this->client->get('reverse', [
            'query' => [
                'lat'    => $lat,
                'lon'    => $lon,
                'format' => 'json',
            ],
            'headers' => [
                'User-Agent' => 'Container' // Ensure this is specific to your app
            ]
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    public function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 3958.8; // Radius of the Earth in miles

        $latDiff = deg2rad($lat2 - $lat1);
        $lonDiff = deg2rad($lon2 - $lon1);

        $a = sin($latDiff / 2) * sin($latDiff / 2) +
             cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
             sin($lonDiff / 2) * sin($lonDiff / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c; // Distance in miles
    }

    public function getDistanceBetweenLocations(Request $request)
    {
        $lat1 = $request->input('lat1');
        $lon1 = $request->input('lon1');
        $lat2 = $request->input('lat2');
        $lon2 = $request->input('lon2');

        $distance = $this->calculateDistance($lat1, $lon1, $lat2, $lon2);

        return response()->json([
            'distance' => $distance . ' miles'
        ]);
    }
}
