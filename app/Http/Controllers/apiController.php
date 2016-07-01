<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

use App\Http\Requests;


class apiController extends Controller
{
    
    //
   public function index(){
   	$baseUri='http://test.localfeedbackloop.com/api/?apiKey=61067f81f8cf7e4a1f673cd230216112&noOfReviews=10&internal=1&yelp=0&google=1&offset=50&threshold=1';
   	$client = new Client(['base_uri' => $baseUri]);
   	$urlr='/?apiKey=61067f81f8cf7e4a1f673cd230216112&noOfReviews=10&internal=1&yelp=0&google=1&offset=50&threshold=1';
   	$response = $client->request('GET');

   	return $response;



    }
}
