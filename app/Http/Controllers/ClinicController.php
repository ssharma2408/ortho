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
		$theUrl     = config('app.api_url').'v1/clinics';	   
		$response   = Http ::withHeaders([
            'Authorization' => 'Bearer '.Session::get('user_details')->token 
        ])->get($theUrl);
		
		$clinic = json_decode($response->body())->data[0];		
		
		
		$clinic_details = ["id"=>$clinic->id, "name"=>$clinic->name];		
		
		Session::put('clinic_details', $clinic_details);
	   
        return view('clinic.show', compact('clinic'));
    }
}
