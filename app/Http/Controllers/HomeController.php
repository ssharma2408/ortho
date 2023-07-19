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

		$close_status = json_decode($response->body())->data->is_clinic_closed;

		if($close_status){
			Session::put('close_status', true);			
		}else{
			session()->forget('close_status');			
		}		
	   return view('home');
	}
	
	public function shortenLink($code){		 
		
		$theUrl     = config('app.api_url').'code/'.$code;
		$response   = Http ::get($theUrl);
				
		$status = json_decode($response->body())->data->status;
		
		if($status){
			return redirect()->route('clinic.home')->with('success', "You have joined the family successfully");		
		}else{
			return redirect()->route('clinic.home')->with('success', "You have already joined the family");	
		}	   
	}
}
