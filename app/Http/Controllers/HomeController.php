<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Session;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
		$theUrl     = config('app.api_url').'clinic-close-status/'.$_ENV['CLINIC_ID'];		
		$response   = Http ::get($theUrl);
				
		$close_status = json_decode($response->body())->data;
		if(count($close_status)){
			Session::put('close_status', true);			
		}else{
			session()->forget('close_status');			
		}		
	   return view('home');
	}
}
