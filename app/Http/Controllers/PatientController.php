<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Session;

use Illuminate\Http\Request;

class PatientController extends Controller
{
  /*   public function index(){
		$theUrl     = config('app.api_url').'v1/doctors/'.$_ENV['CLINIC_ID'];
		$response   = Http ::withHeaders([
            'Authorization' => 'Bearer '.Session::get('user_details')->token 
        ])->get($theUrl);

		$doctors = json_decode($response->body())->data[0]->doctors;

	   return view('doctors.index', compact('doctors'));
	}
	
	public function view(Request $request){
		$theUrl     = config('app.api_url').'v1/doctors/'.$_ENV['CLINIC_ID'].'/'.$request->doctor_id;
		$response   = Http ::withHeaders([
            'Authorization' => 'Bearer '.Session::get('user_details')->token 
        ])->get($theUrl);

		$details = json_decode($response->body())->data;
		
		if(!empty($details->opening_hours)){
			$timing_arr = [];
			foreach($details->opening_hours as $timing){
				$timing_arr[$timing->day][] = $timing;
			}
			$details->opening_hours = $timing_arr;
		}
		
		$day_arr = array("Monday", "Tuseday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");

		return view('doctors.view', compact('details', 'day_arr'));
	   
	} */
	
	public function dashboard()
    {
		$theUrl     = config('app.api_url').'v1/doctors_timing/'.$_ENV['CLINIC_ID'];
		$response   = Http ::withHeaders([
            'Authorization' => 'Bearer '.Session::get('user_details')->token
        ])->get($theUrl);

		$doctors = json_decode($response->body())->data;
		
		$doctor_arr = [];
		$day_arr = array("Monday", "Tuseday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
		
		foreach($doctors as $doctor){			
			$doc['id'] = $doctor->id;
			$doc['name'] = $doctor->name;
			$doc['timings'][$doctor->day][] = array('start_hour'=>$doctor->start_hour, 'end_hour'=>$doctor->end_hour);			
			$doctor_arr = array($doc);
		}

		return view('patients.dashboard', compact('doctor_arr', 'day_arr'));
    }
	
	public function book_appointment(Request $request)
    {
		$theUrl     = config('app.api_url').'v1/tokens';
		
		$post_arr = [			
			'doctor_id'=>$request->doctor_id,
			'patient_id'=>Session::get('user_details')->id,
			'clinic_id'=>$_ENV['CLINIC_ID'],
		];

		$response   = Http ::withHeaders([
            'Authorization' => 'Bearer '.Session::get('user_details')->token 
        ])->post($theUrl, $post_arr);
		
		$token = json_decode($response->body())->data[0];

		if(isset($token->token_number)){
			$msg = "Appointment booked successfully.";
			return response()->json(array('success'=>1, 'msg'=> $msg, 'token'=>$token), 200);
		}else{
			$msg = "There is a technical error, please try after sometime";
			return response()->json(array('success'=>0,'msg'=> $msg, 'token'=>""), 200);
		}
			
    }	
	
}
