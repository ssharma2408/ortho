<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;

use Illuminate\Support\Facades\Crypt;

use Session;
use Hash;

class StaffController extends Controller
{
    public function index()
    {
        $theUrl     = config('app.api_url').'v1/staffs';	   
		$response   = Http ::withHeaders([
            'Authorization' => 'Bearer '.Session::get('user_details')->token 
        ])->get($theUrl, [
				'clinic_id'=>$_ENV['CLINIC_ID']				
			]);
		
		$staffs = json_decode($response->body())->data;		

        return view('staffs.index', compact('staffs'));
        
    }

    public function create()
    {
        //abort_if(Gate::denies('staff_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        //$clinics = Clinic::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        //return view('staffs.create', compact('clinics'));
        return view('staffs.create');
    }

    public function store(Request $request)
    {		
		
		$theUrl     = config('app.api_url').'v1/staffs';
		
		$post_arr = [
			'name'=>$request['name'],
			'email'=>$request['email'],
			'mobile_number'=>$request['mobile'],
			'username'=>Session::get('user_details')->prefix."_".$request['username'],
			'password'=>Hash::make($request['password']),
			'clinic_id'=>$_ENV['CLINIC_ID'],
		];
		
		$response   = Http ::withHeaders([
            'Authorization' => 'Bearer '.Session::get('user_details')->token 
        ])->post($theUrl, $post_arr);
		
		$staff = json_decode($response->body());
		

        return redirect()->route('staffs.index');
    }

    public function edit()
    {		
		$url_arr = explode("/", url()->full());

		$staff_id = $url_arr[count($url_arr)-2];
		
		$theUrl     = config('app.api_url').'v1/staffs/'.$staff_id;
		$response   = Http ::withHeaders([
            'Authorization' => 'Bearer '.Session::get('user_details')->token 
        ])->get($theUrl);
		
		$staff = json_decode($response->body())->data;
		
		$staff->username = explode("_", $staff->username)[0];		

        return view('staffs.edit', compact('staff'));
        
    }

    public function update(Request $request)
    {
        
		$url_arr = explode("/", url()->full());

		$staff_id = $url_arr[count($url_arr)-1];	
		
		$post_arr = [
			'name'=>$request['name'],
			'email'=>$request['email'],
			'mobile_number'=>$request['mobile'],
			'username'=>Session::get('user_details')->prefix."_".$request['username'],			
			'clinic_id'=>$_ENV['CLINIC_ID'],
		];
		
		if(trim($request['password']) != ""){
			$post_arr['password'] = Hash::make(trim($request['password']));
		}
		
		$theUrl     = config('app.api_url').'v1/staffs/'.$staff_id;
		$response   = Http ::withHeaders([
            'Authorization' => 'Bearer '.Session::get('user_details')->token 
        ])->put($theUrl, $post_arr);
		
		$staff = json_decode($response->body());

        return redirect()->route('staffs.index');
    }

    public function show()
    {
        
		$url_arr = explode("/", url()->full());

		$staff_id = $url_arr[count($url_arr)-1];
		
		$theUrl     = config('app.api_url').'v1/staffs/'.$staff_id;
		$response   = Http ::withHeaders([
            'Authorization' => 'Bearer '.Session::get('user_details')->token 
        ])->get($theUrl);
		
		$staff = json_decode($response->body())->data;	

        return view('staffs.show', compact('staff'));
        
    }

    public function destroy()
    {
        
		$url_arr = explode("/", url()->full());

		$staff_id = $url_arr[count($url_arr)-1];
		
		$theUrl     = config('app.api_url').'v1/staffs/'.$staff_id;

		$response   = Http ::withHeaders([
            'Authorization' => 'Bearer '.Session::get('user_details')->token			
        ])->delete($theUrl);	

        return redirect()->route('staffs.index');
    }
}
