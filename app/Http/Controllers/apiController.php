<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

use App\Http\Requests;


class apiController extends Controller
{
    
    
   public function index(Request $request){

   	$google=$request->input('google');
   	$google=isset($google)?$google:'1';

   	$internal=$request->input('internal');
   	$internal=isset($internal)?$internal:'1';

   	$yelp=$request->input('yelp');
   	$yelp=isset($yelp)?$yelp:'1';

   
   	

   	$baseUri="http://test.localfeedbackloop.com/api/?apiKey=61067f81f8cf7e4a1f673cd230216112&noOfReviews=10&internal=$internal&yelp=$yelp&google=$google&offset=50&threshold=1";


   	$client = new Client(['base_uri' => $baseUri]);
   
   	$response = $client->request('GET');

   	return $response;



    }
}
