<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Computer;

class GlpiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "http://glpi.local/apirest.php/initSession/",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json",
            "App-Token: Yft70qFwTJmfhRqQZbl1JtIdciZa4HC4LFsu5XJL",
            "Authorization: Basic Z2xwaTpnbHBp"
          ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);


       $obj = json_decode($response,true);
       $sess_token = $obj['session_token'];
       define('SSTOKEN', $sess_token);
       $curl2 = curl_init();

       $data = [];

        curl_setopt_array($curl2, array(
            CURLOPT_URL => "http://glpi.local/apirest.php/Computer/",
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_ENCODING => "urf8",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
              "Session-Token: ". SSTOKEN,
              'Accept:application/json',
              'Content-Type:application/json',
              "App-Token: Yft70qFwTJmfhRqQZbl1JtIdciZa4HC4LFsu5XJL"
            ),
          ));
        $data['response'] = json_decode(curl_exec($curl2));
        curl_close($curl2);

        $computers = [];

        foreach($data['response'] as $obj) {
            $c = new Computer($obj);
            array_push($computers, $c);
        }
        $data['computers'] = $computers;
        //dd($computers);
        return view('glpi.load', $data );

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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
