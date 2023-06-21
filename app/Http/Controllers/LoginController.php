<?php

namespace App\Http\Controllers;
use Session;

use Illuminate\Http\Request;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class LoginController extends Controller
{
    /**
     * Display login page.
     * 
     * @return Renderable
     */
    public function show()
    {
        return view('login');
    }	
	
	/**
     * Display register page for patient.
     * 
     * @return Renderable
     */
    public function patient_register()
    {
        return view('patient_register');
    }	

	/**
     * Display register page for patient.
     * 
     * @return Renderable
     */
    public function patient_register_save(Request $request)
    {
        
		$post_arr = [
			'name'=>$request['name'],
			'mobile_number'=>$request['mobile_no'],
			'domain'=>$_ENV['DOMAIN'],
			'clinic_id'=>$_ENV['CLINIC_ID'],
		];		

		$response = Http::post(config('app.api_url').'patient_register', $post_arr);
		$result = json_decode($response->body());
		
		if($result->success && $result->data->token){
			
			$patient = $result->data;
			
			return redirect()->to('patient_login')
                ->with('success', $result->message);
			
		}else{
			
			return redirect()->to('/')
                ->withErrors($result->data->error);
		}
		
    }
	
	/**
     * Display login page for patient.
     * 
     * @return Renderable
     */
    public function patient_login()
    {
        return view('patient_login');
    }

	/**
     * Display OTP page for patient.
     * 
     * @return Renderable
     */
    public function patient_gen_otp(Request $request)
    {
        
		$post_arr = [			
			'mobile_number'=>$request['mobile_no'],
			'domain'=>$_ENV['DOMAIN'],
			'clinic_id'=>$_ENV['CLINIC_ID'],
		];		

		$response = Http::withHeaders([
            'Accept' => 'application/json' 
        ])->post(config('app.api_url').'patientlogin', $post_arr);
		
		
		$result = json_decode($response->body());		
		
		if(isset($result->success)){
			if($result->success && $result->data->patient_id){
				
				$patient_id = $result->data->patient_id;
				
				return redirect()->to('patient_verification')
					->with(['success'=> $result->message, 'patient_id'=>$patient_id]);			
				
			}else{
				
				return redirect()->to('/')
					->withErrors($result->data->error);
			}
		}else{
			return redirect()->to('patient_login')
					->withErrors("There is a technical error. Please try after some time");
		}
    }	

	/**
     * Display OTP page for patient.
     * 
     * @return Renderable
     */
    public function patient_verify()
    {
        return view('otpVerification');
    }

	
	/**
     * Display OTP page for patient.
     * 
     * @return Renderable
     */
    public function patient_verify_process(Request $request)
    {
        $post_arr = [			
			'patient_id'=>$request['patient_id'],
			'otp'=>$request['otp'],
			'domain'=>$_ENV['DOMAIN'],
			'clinic_id'=>$_ENV['CLINIC_ID'],
		];		

		$response = Http::withHeaders([
            'Accept' => 'application/json' 
        ])->post(config('app.api_url').'patientloginwithotp', $post_arr);
		
		
		$result = json_decode($response->body());
		
		if($result->success){
			
			$patient = $result->data;
			Session::put('user_details', $patient);			

			return $this->authenticated($request, $patient);
			
		}else{
			
			return redirect()->to('patient_login')
                ->withErrors($result->data->error);
		}
    }
	
	/**
     * Handle account login request
     * 
     * @param LoginRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->getCredentials();		

		$response = Http::post(config('app.api_url').'login', [
			'email'=>isset($credentials['email']) ? $credentials['email'] : $credentials['username'],
			'password'=>$credentials['password'],
			'domain'=>$_ENV['DOMAIN'],
			'clinic_id'=>$_ENV['CLINIC_ID'],
		]);		
		$result = json_decode($response->body());		
		
		if(isset($result->success)){
			if($result->success && $result->data->token){
				
				$user = $result->data;
				Session::put('user_details', $user);
				
				//Auth::login($user);

				return $this->authenticated($request, $user);
				
			}else{
				
				return redirect()->to('login')
					->withErrors($result->data->error);
			}
		}else{
			return redirect()->to('login')
					->withErrors("There is a technical error. Please try after some time");
		}
    }
	
	/**
     * Handle response after user authenticated
     * 
     * @param Request $request
     * @param Auth $user
     * 
     * @return \Illuminate\Http\Response
     */
    protected function authenticated(Request $request, $user) 
    {
        $dashboard = "";
		
		switch($user->role){
			case "Clinic Admin":
				$dashboard = "ca_dashboard";
				break;
			case "Doctor":
				$dashboard = "doctor_dashboard";
				break;
			case "Staff":
				$dashboard = "staff_dashboard";
				break;
			default :
				$dashboard = "user_dashboard";
				break;				
		}
		return redirect()->intended($dashboard);
    }
	
	/**
     * Handle account login request
     * 
     * @param LoginRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
       $request->session()->flush();
	   return redirect()->to('login')
			->with('success', 'Logout successfully');
    }
}
