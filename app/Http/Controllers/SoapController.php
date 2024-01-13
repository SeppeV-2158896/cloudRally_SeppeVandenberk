<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RicorocksDigitalAgency\Soap\Facades\Soap;
use Illuminate\Support\Facades\Log;

class SoapController extends Controller
{
    public function callSoapService(){
        return view('SOAP/calendar');
    }

    public function getRallyByName($name){
        $decodedName = urldecode($name);

        $options = [
            'cache_wsdl' => WSDL_CACHE_NONE,
            'trace' => 1,
            'stream_context' => stream_context_create([
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true,
                ],
            ]),
        ];
        $endpoint = "http://localhost:8080/ws/rally.wsdl";
        $request = ['name' => $decodedName];
        $response = Soap::to($endpoint)->call('getRallyByName', $request);
        $responseString = json_encode($response);
        
        return $responseString;
    }

    public function getAllRallies(){
        $options = [
            'cache_wsdl' => WSDL_CACHE_NONE,
            'trace' => 1,
            'stream_context' => stream_context_create([
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true,
                ],
            ]),
        ];
        $endpoint = "http://localhost:8080/ws/rally.wsdl";
        $response = Soap::to($endpoint)->getRallies();
 
        $responseString = json_encode($response);

        return $responseString; 
    }

    public function getRalliesByLocation($longitude, $latitude){
        $options = [
            'cache_wsdl' => WSDL_CACHE_NONE,
            'trace' => 1,
            'stream_context' => stream_context_create([
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true,
                ],
            ]),
        ];
        $endpoint = "http://localhost:8080/ws/rally.wsdl";
        $request = ['longitude'=> $longitude, 'latitude' => $latitude];
        $response = Soap::to($endpoint)->call('getRalliesByLocation', $request);
        $responseString = json_encode($response);
             

        return $responseString;


    }

    public function getAllFutureRallies(){
        $options = [
            'cache_wsdl' => WSDL_CACHE_NONE,
            'trace' => 1,
            'stream_context' => stream_context_create([
                'ssl' => [
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true,
                ],
            ]),
        ];
        $endpoint = "http://localhost:8080/ws/rally.wsdl";
        $response = Soap::to($endpoint)->call('getFutureRallies');
        $responseString = json_encode($response);

        return $responseString;
    }
}
