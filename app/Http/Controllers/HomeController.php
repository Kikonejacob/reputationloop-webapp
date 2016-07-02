<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use View;

class HomeController extends Controller
{
	/** Return Application page */
    public function index(){

    	return  View::make('business.index');
    }
}
