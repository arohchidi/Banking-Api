<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Validator;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
   

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    
    
    
    public function login(){
        return view('login');
    }
    
    
    //login customer
    
    public function authenticateUser(Request $request){
        
            $credentials = $request->only('email','password');
       
            //validate customer's input
        $validator = Validator::make($request->all(), [
            
            'email' => 'required',
           'password' => 'required',
         
            
        ]);
        
       
        //return json error if validation fails 
         if ($validator->fails()) {
            return json_encode($validator->errors());
        }
        
        try{
           if(Auth::attempt(['email' => $request['email'], 'password' => $request['password']])){
               
             return response()->json(['success' => 'You are logged in.'],200);
               
           }
            else{
               return  response()->json(['error' => 'Invalid credentails'],401);
            }
           
		   
		}
            
        
        catch (Exception $e) {
            return Response::json(['error' => 'Invalid credentials'], HttpResponse::HTTP_CONFLICT);
        }
        

       
        
        
        
    }
    
 public function logout(Request $request) {
  Auth::logout();
  return response()->json(['success', 'You have logged out'],200);
}

    
    
    
}
