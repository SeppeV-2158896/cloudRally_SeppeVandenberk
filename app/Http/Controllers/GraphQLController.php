<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GraphQL\GraphQL;
use Nuwave\Lighthouse\Support\Facades\GraphQL as GraphQLFacade;

class GraphQLController extends Controller
{
    public function query(Request $request)
    {
        
    $url = 'http://localhost:8000/wrc/graphql'; 

    $data = json_encode(['query' => $request->query]);
    $csrfToken = csrf_token();

    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'X-CSRF-TOKEN: ' . $csrfToken,
    ]);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        die('Curl error: ' . curl_error($ch));
    }

    curl_close($ch);

    $result = json_decode($response, true);

    print_r($result);
    }

    public function getAllTeams($request){

        $jsonData = json_decode($request->getContent(), true);
        return view ('teams')->with('data', $jsonData['data']);
    }
    
}
