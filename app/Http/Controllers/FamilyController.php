<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use Session;

class FamilyController extends Controller
{
    public function index()
	{
		$theUrl     = config('app.api_url').'v1/patient_family/'.Session::get('user_details')->family_id;
		$response   = Http ::withHeaders([
            'Authorization' => 'Bearer '.Session::get('user_details')->token
        ])->get($theUrl);
		
		$members = json_decode($response->body())->data;
		
		return view('patients.family.index', compact('members'));
	}
	
	 public function create()
    {
        return view('patients.family.create');
    }
	
	public function store(Request $request)
    {		
		
		$theUrl     = config('app.api_url').'v1/patient_family';		
		
		$post_arr = [
			'name'=>$request['name'],			
			'mobile_number'=>isset($request['has_mobile']) ? '+91'.$request['mobile_number'] : "",
			'clinic_id'=>$_ENV['CLINIC_ID'],
			'gender'=>$request['gender'],
			'dob'=>$request['dob'],
			'family_id'=>Session::get('user_details')->family_id
		];

		$response   = Http ::withHeaders([
            'Authorization' => 'Bearer '.Session::get('user_details')->token 
        ])->post($theUrl, $post_arr);
		
		$member = json_decode($response->body());

		if(isset($member->data->id)){
			return redirect()->route('family.index')->with('success', "Member added successfully");
		}else{
			return redirect()->route('family.index')->with('success', "Member is already exist in the system.");
		}
    }
}
