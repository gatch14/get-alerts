<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiDataController extends Controller
{
    /**
     * Store in Json api date coinmarketcap
     */
    public function storeDataInJson()
    {
        $url = "https://api.coinmarketcap.com/v1/ticker/?limit=0";
        $data = file_get_contents($url);

        $cryptos = '../resources/cryptos.json';

        $fichier = fopen($cryptos, 'w+');

        fwrite($fichier, $data);

        fclose($fichier);

        return response()->json(['data' => 'ok']);
    }

    /**
     * Read Json file
     */
    public function readJson()
    {
        $json_source = file_get_contents('../resources/cryptos.json');

        $data = json_decode($json_source);

        return response()->json(['data' => $data]);
    }

    /**
     * add symbol in array
     */
    public function symbol()
    {
        $json_source = file_get_contents('../resources/cryptos.json');
        //on decode
        $json = json_decode($json_source);
        $data = array();
        foreach ($json as $key) {
            array_push($data, $key->symbol);
        }

        return response()->json([$data]);
    }
}
