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

		$type = ["type_1"=>"Self, Spouse or Parents", "type_2"=>"Children"];

		return view('patients.family.index', compact('members', 'type'));
	}
	
	 public function create()
    {
        return view('patients.family.create');
    }
	
	public function store(Request $request)
    {		
		
		$theUrl     = config('app.api_url').'v1/patients';		
		
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
	
	public function edit_member(Request $request){
		
		$theUrl     = config('app.api_url').'v1/get_member/'.Session::get('user_details')->family_id."/".$request->id."/".$request->type;
		$response   = Http ::withHeaders([
            'Authorization' => 'Bearer '.Session::get('user_details')->token
        ])->get($theUrl);
		
		$member = json_decode($response->body())->data[0];
		$type = $request->type;

		return view('patients.family.edit', compact('member', 'type'));
	}
	
	public function update(Request $request)
    {		
		
		$theUrl     = config('app.api_url').'v1/update_member';
	
		$post_arr = [
			'id'=> $request['id'],
			'name'=>$request['name'],			
			'gender'=>$request['gender'],
			'dob'=>$request['dob'],
			'family_id'=>Session::get('user_details')->family_id,			
		];

		if(isset($request['mobile_number'])){
			$post_arr['mobile_number'] = '+91'.$request['mobile_number'];
			$post_arr['clinic_id'] = $_ENV['CLINIC_ID'];
		}

		$response   = Http ::withHeaders([
            'Authorization' => 'Bearer '.Session::get('user_details')->token 
        ])->post($theUrl, $post_arr);

		$member = json_decode($response->body());

		if(isset($member->data->success)){
			return redirect()->route('family.index')->with('success', "Member updated successfully");
		}else{
			return redirect()->route('family.index')->with('success', "There is a technical error");
		}
    }
	
	public function destroy(Request $request)
	{
		$url_arr = explode("/", url()->full());

		$member_id = $url_arr[count($url_arr)-1];
		
		$theUrl     = config('app.api_url').'v1/remove_member/'.Session::get('user_details')->family_id."/".$member_id."/".$request->type;

		$response   = Http ::withHeaders([
            'Authorization' => 'Bearer '.Session::get('user_details')->token
        ])->get($theUrl);		

		return redirect()->route('family.index')->with('success', "Member removed successfully");
		
	}
}
