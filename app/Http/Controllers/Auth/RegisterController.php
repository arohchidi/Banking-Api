<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
   
    
    
    public function signUp(){
        return view('register');
    }
    
    //register customer
    
    public function createAccount(Request $request){
        
         $credentials = $request->only('firstname','lastname','email', 'password','type_of_account','pin');
       
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|alpha|max:255',
            'lastname' => 'required|alpha|max:255',
            'email' => 'required|email|max:255|unique:users',
            
            
             'password' => 'required|min:6',
             'pin' => 'required|min:4|max:4|numeric',
            
        ]);
   
        //create a unique account number for the customer starting 3.
          $account_number =  str_pad(mt_rand(0, 999999999), 10, '30', STR_PAD_LEFT);
             //validate customer's credentials
        if ($validator->fails()) {
            return json_encode($validator->errors());
        }
        try {
           
            $user = new User;
            $user->firstname = $request->firstname;
            $user->lastname = $request->lastname;
            $user->email = $request->email;
                $user->pin = $request->pin;   
            $user->password = bcrypt($request->password);
            $user->type_of_account = $request->type_of_account;
            $user->account_number = $account_number;
            $user->save();
        } catch (Exception $e) {
            return Response::json(['error' => 'Customer already exists.'], HttpResponse::HTTP_CONFLICT);
        } 
        catch(\Illuminate\Database\QueryException $ex){ 
            return json_encode($ex); 
        }

       
        //return a json response with the customer's account number
        return response()->json(['success' => 'Hello,'.$request->firstname. ' '. $request->lastname .' '. 'your account has been created'.' '.$account_number]);
        
        
        
    }
    
  
    
   
        
    
}
