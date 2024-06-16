<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
class DniController extends Controller
{
    public function consultaDni($dni)
    {
    $token = env('API_DNI_CONSULTA');
    $numero = $dni;
    $client = new Client(['base_uri' => 'https://api.apis.net.pe', 'verify' => false]);
    $parameters = [
        'http_errors' => true,
        'connect_timeout' => 5,
        'headers' => [
            'Authorization' => 'Bearer '.$token,
            'Referer' => 'https://apis.net.pe/api-consulta-dni',
            'User-Agent' => 'laravel/guzzle',
            'Accept' => 'application/json',
        ],
        'query' => ['numero' => $numero]
    ];
    $res = $client->request('GET', '/v2/reniec/dni', $parameters);
    $response = json_decode($res->getBody()->getContents(), true);
    //var_dump($response);

    return view('DniConsulta', ['dni' => $response]);
    }
}
//https://api.apis.net.pe/v2/reniec/dni?numero=46027897
