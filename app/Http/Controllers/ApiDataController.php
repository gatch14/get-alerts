<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\Crypto;
use App\Mail\AlertUsers;
use Illuminate\Support\Facades\Mail;

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
    public function getSymbol()
    {
        $json_source = file_get_contents('../resources/cryptos.json');

        $json = json_decode($json_source);

        $data = array();
        foreach ($json as $key) {
            array_push($data, $key->symbol);
        }

        return $data;
    }

    /**
     * check if alert
     */
    public function checkAlert()
    {
        $json_source = file_get_contents('../resources/cryptos.json');

        $data = json_decode($json_source);

        $cryptos = Crypto::where('alerted', 0)->get();

        /**
         * Find alert
         */
        $result = [];
        foreach ($data as $key => $value) {
            foreach ($cryptos as $crypto){
                if ($crypto->choices_value === '$' && $data[$key]->symbol === $crypto->name){
                    if ($data[$key]->price_usd > $crypto->price
                        && $crypto->choices === 'high'){
                            array_push($result, $crypto->id);
                    } elseif ($data[$key]->price_usd < $crypto->price
                        && $crypto->choices === 'low'){
                            array_push($result, $crypto->id);
                    }
                } elseif ($crypto->choices_value === 'BTC' && $data[$key]->symbol === $crypto->name){
                    if ($data[$key]->price_btc > $crypto->price
                        && $crypto->choices === 'high'){
                            array_push($result, $crypto->id);
                    } elseif ($data[$key]->price_btc < $crypto->price
                        && $crypto->choices === 'low'){
                            array_push($result, $crypto->id);
                    }
                }
            }
        }

        $alerts = Crypto::select('email', 'cryptos.*')
        ->join('users', 'users.id', '=', 'cryptos.user_id')
        ->whereIn('cryptos.id', $result)
        ->get()
        ->groupBy('email');

        foreach ($alerts as $mail => $cryptos){
            $mailable = new AlertUsers($mail, $cryptos);
            Mail::to('admin@alerted.com')->send($mailable);
            foreach ($cryptos as $crypto){
                Crypto::where('id', $crypto->id)
                    ->update(['alerted' => 1]);
            }
        }

        return response()->json(['ok']);
    }
}
