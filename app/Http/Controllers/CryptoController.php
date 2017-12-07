<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\model\Crypto;
use App\Http\Requests\StoreCryptoRequest;
use App\Http\Requests\UpdateCryptoRequest;

class CryptoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cryptos = Crypto::where('user_id', Auth::user()->id )->get();

        return response()->json(['data' => $cryptos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCryptoRequest $request)
    {
        $data = new Crypto;
        $data->name = request('name');
        $data->price = request('price');
        $data->choices = request('choices');
        $data->choices_value = request('choices_value');
        $data->user_id = Auth::user()->id;
        $data->save();
        return response()->json(['result' => 'ok']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $crypto = Crypto::where('user_id', Auth::user()->id )
            ->where('id', $id)
            ->get();

        return response()->json(['data' => $crypto]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCryptoRequest $request, $id)
    {
        $crypto = Crypto::where('user_id', Auth::user()->id )
            ->where('id', $id)
            ->update($request->all());

        return response()->json(['data' => $crypto]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $crypto = Crypto::where('user_id', Auth::user()->id )
            ->where('id', $id)
            ->delete();

        return response()->json(['data' => $crypto]);
    }
}
