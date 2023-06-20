<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Session;

class ClinicController extends Controller
{  
	
	public function dashboard()
    {
		return view('clinic.dashboard');
    }
	 
	 public function show()
    {
		$theUrl     = config('app.api_url').'v1/clinics/'.$_ENV['CLINIC_ID'];	   
		$response   = Http ::withHeaders([
            'Authorization' => 'Bearer '.Session::get('user_details')->token 
        ])->get($theUrl);
				
		$clinic = json_decode($response->body())->data;
		
		if(!empty($clinic->opening_hours)){
			$timing_arr = [];
			foreach($clinic->opening_hours as $timing){
				$timing_arr[$timing->day][] = $timing;
			}
			$clinic->opening_hours = $timing_arr;
		}
		
		$day_arr = array("Monday", "Tuseday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
		
		//get closed days
		$theUrl     = config('app.api_url').'v1/closed-timings/'.$clinic->clinic_admin->id;
		$response   = Http ::withHeaders([
            'Authorization' => 'Bearer '.Session::get('user_details')->token 
        ])->get($theUrl);
				
		$closed_days = json_decode($response->body())->data;		
		
        return view('clinic.show', compact('clinic', 'day_arr', 'closed_days'));
    }
}
