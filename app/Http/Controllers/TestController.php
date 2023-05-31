<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function getClinic(){
	   $theUrl     = config('app.api_url').'v1/clinics';	   
	   $clinic   = Http ::get($theUrl);	   
	   return view('clinic.index', compact('clinic'));
	}
}
