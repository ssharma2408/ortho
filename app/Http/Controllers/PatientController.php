<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Session;

use Illuminate\Http\Request;

class PatientController extends Controller
{
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
			$doctor_arr[$doctor->id]['id'] = $doctor->id;
			$doctor_arr[$doctor->id]['name'] = $doctor->name;
			$doctor_arr[$doctor->id]['timings'][$doctor->day][] = array('start_hour'=>$doctor->start_hour, 'end_hour'=>$doctor->end_hour, 'slot_id'=>$doctor->slot_id);
		}

		foreach($doctor_arr as $index => $doc){
			$theUrl     = config('app.api_url').'v1/check_status/'.$_ENV['CLINIC_ID'].'/'.$doc['id'].'/'.Session::get('user_details')->id;
			$response   = Http ::withHeaders([
				'Authorization' => 'Bearer '.Session::get('user_details')->token
			])->get($theUrl);
			$res = json_decode($response->body());
			if(!empty($res)){
				foreach($res->data as $time){
					$doctor_arr[$index]['is_booked'][] = $time->timing_id;
				}				
			}
		}

		return view('patients.dashboard', compact('doctor_arr', 'day_arr'));
    }
	
	public function book_appointment(Request $request)
    {
		$theUrl     = config('app.api_url').'v1/tokens';
		
		$post_arr = [			
			'doctor_id'=>$request->doctor_id,
			'slot_id'=>$request->slot_id,
			'patient_id'=>Session::get('user_details')->id,
			'clinic_id'=>$_ENV['CLINIC_ID'],
		];

		$response   = Http ::withHeaders([
            'Authorization' => 'Bearer '.Session::get('user_details')->token 
        ])->post($theUrl, $post_arr);
		
		$token = json_decode($response->body())->data;

		if(isset($token->token_number)){
			$msg = "Appointment booked successfully.";
			return response()->json(array('success'=>1, 'msg'=> $msg, 'token'=>$token), 200);
		}else{
			$msg = "There is a technical error, please try after sometime";
			return response()->json(array('success'=>0,'msg'=> $msg, 'token'=>""), 200);
		}
    }
	
	public function refresh_status(Request $request)
    {
		$theUrl     = config('app.api_url').'v1/refresh_status/'.$_ENV['CLINIC_ID'].'/'.$request->doctor_id.'/'.$request->slot_id.'/'.Session::get('user_details')->id;

		$response   = Http ::withHeaders([
            'Authorization' => 'Bearer '.Session::get('user_details')->token
        ])->get($theUrl);


		$status = json_decode($response->body());

		if(isset($status->data)){			
			return response()->json(array('success'=>1, 'token'=>$status->data), 200);
		}else{
			$msg = "No records found or there is a technical error, please try after sometime";
			return response()->json(array('success'=>0,'msg'=> $msg, 'token'=>""), 200);
		}
    }	
}
