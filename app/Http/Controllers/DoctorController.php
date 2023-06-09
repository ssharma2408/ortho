<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Session;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index(){
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
	   
	}
	
	public function dashboard()
    {
		return view('doctors.dashboard');
    }
	
	public function current_appointments()
    {
		$theUrl     = config('app.api_url').'v1/tokens/'.$_ENV['CLINIC_ID'].'/'.Session::get('user_details')->user_id;
		$response   = Http ::withHeaders([
            'Authorization' => 'Bearer '.Session::get('user_details')->token 
        ])->get($theUrl);
		
		$patients = json_decode($response->body())->data;
		
		$patient_arr = [];
		
		foreach($patients as $patient){
			$patient_arr[$patient->start_hour."-".$patient->end_hour][] = $patient;
		}

		return view('doctors.current_appointments', compact('patient_arr'));
    }
	
	public function update_token(Request $request)
	{
		
		if ($request->hasFile('prescription')) {			

			//Upload file to S3 Bucket and set path to Prescription
			$extension  = request()->file('prescription')->getClientOriginalExtension();
            $image_name = time() .'_' . $request->patient_id . '.' . $extension;
            $path = $request->file('prescription')->storeAs(
                'patient_'.$request->patient_id,
                $image_name,
                's3'
            );
			$aws_path = Storage::disk('s3')->url($path);
			
			$theUrl     = config('app.api_url').'v1/update_token';		

			$post_arr = [			
				'doctor_id'=>Session::get('user_details')->user_id,
				'patient_id'=>$request->patient_id,
				'slot_id'=>$request->slot_id,
				'status'=>$request->status,
				'clinic_id'=>$_ENV['CLINIC_ID'],
				'comment'=>$request->comment,
				'prescription'=>$aws_path,
			];

			$response   = Http ::withHeaders([
				'Authorization' => 'Bearer '.Session::get('user_details')->token 
			])->post($theUrl, $post_arr);		
			
			$msg = "Status updated successfully.";
			return response()->json(array('success'=>1, 'msg'=> $msg), 200);
		}else{
			$msg = "Error";
			return response()->json(array('success'=>0, 'msg'=> $msg), 200);
		}		
	}
	
	public function edit(Request $request)
	{
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

		return view('doctors.doctor_edit', compact('details', 'day_arr'));
	}
	public function save(Request $request)
    {		
		$theUrl     = config('app.api_url').'v1/timings-save';
		
		$response   = Http ::withHeaders([
            'Authorization' => 'Bearer '.Session::get('user_details')->token 
        ])->post($theUrl, $request->all());

		$response = json_decode($response->body());		
		$route = 'clinicadmin.show';
		
		if($request->type =='doctor'){
			$route = 'doctors.index';
		}
        return redirect()->route($route)->with('success', "Timings updated successfully");
    }
	
	public function patients()
    {
		$theUrl     = config('app.api_url').'v1/patients/'.$_ENV['CLINIC_ID'].'/'.Session::get('user_details')->user_id;
		$response   = Http ::withHeaders([
            'Authorization' => 'Bearer '.Session::get('user_details')->token 
        ])->get($theUrl);
		
		$patients = json_decode($response->body())->data;		
		
		$patient_arr = [];
		
		foreach($patients as $patient){
			$patient_arr[$patient->id]['name'] = $patient->name;
			$patient_arr[$patient->id]['visit_date'][] = array('visit_date' => $patient->visit_date, 'history_id' => $patient->history_id);
		}

		return view('doctors.patients', compact('patient_arr'));
    }
	
	public function get_history(Request $request)
	{
		$theUrl     = config('app.api_url').'v1/patient-histories/'.$request->id;
		$response   = Http ::withHeaders([
            'Authorization' => 'Bearer '.Session::get('user_details')->token 
        ])->get($theUrl);
			
		$history = json_decode($response->body())->data;
		
		return response()->json(array('success'=>1, 'history'=>$history), 200);
	}
}
