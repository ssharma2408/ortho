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
		
		if($result->success && $result->data->token){
			
			$user = $result->data;
			Session::put('user_details', $user);
			
			//Auth::login($user);

			return $this->authenticated($request, $user);
			
		}else{
			
			return redirect()->to('login')
                ->withErrors($result->data->error);
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
