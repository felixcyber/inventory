<?php

namespace App;

class Computer
{
    public $access_token;

    function __construct($obj)
    {
        foreach ($obj as $key => $val) {
            $this->$key = $val;
        }
    }


    public function getComputerDetais($comp_param)
    {

        foreach ($this->links as $l)

        {

            // if ($l->rel == 'ComputerModel') {

            if ($l->rel ==  $comp_param) {
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => $l->href,
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_ENCODING => "urf8",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_HTTPHEADER => array(
                        "Session-Token: " . SSTOKEN,
                        'Accept:application/json',
                        'Content-Type:application/json',
                        "App-Token: Yft70qFwTJmfhRqQZbl1JtIdciZa4HC4LFsu5XJL"
                    ),
                ));
                $detail = json_decode(curl_exec($curl));
                curl_close($curl);


                //dd($detail);
                return $detail;

            }

        }
        //dd('Here!');

        return false;

    }
}
