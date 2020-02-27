<?php

namespace App\Http\Controllers;

use App\User;
use App\Deposits;
use App\Withdrawals;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use Illuminate\Http\Request;


class WithdrawalController extends Controller
{
  

    


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
   
    
    
    
    
    //process withdrawals
    
    public function processWithdrawal(Request $request){
        
        
        
        
        //check if user is logged in
         $user = Auth::user();
        if($user){
         $credentials = $request->only('amount','account_number', 'type_of_account','pin');
       
        $validator = Validator::make($request->all(), [
           
            'amount' => 'required',
            'account_number' => 'required',
            'type_of_account' => 'required',
            'pin' => 'required|min:4|max:4|numeric',
            
        ]);
   
        
             //validate customer's credentials
        if ($validator->fails()) {
            return json_encode($validator->errors());
        }
        
        
        
        
        
        try {
            
            
            //check if account number exists in database
            
            $account_number = User::where('account_number','=', $request->account_number)->first();
            
            //if account number exists
            if($account_number){
                //get the account type and cross check if is the same with depositor's input.
                
                $type_of_account = $account_number->type_of_account;
                 $pin = $account_number->pin;
                    $user_id = $account_number->id;
                  $balance = $account_number->balance;
                //if data are correct, save to db
                if($type_of_account == $request->type_of_account && $pin == $request->pin){
                    
                   
                   
                    
                    //check if the withdrawal amount is not bigger than total amount deposited
                    if($balance > $request->amount){
                        //insert withdrawal request into db
                        $withdrawal =  new Withdrawals();
                        $withdrawal->user_id= $user_id;
                       $withdrawal->amount = $request->amount;
                       $withdrawal->status = 'successful';
                        
                       $withdrawal->save();
                        
                        $new_balance = $balance - $request->amount;
                        
                        //update balance on user table
                        $user = User::where('id', $user_id)->update(['balance' => $new_balance]);
                        
                        
                    }
                    else{
                        //return response when account balance is not up to the withdrawal amount request.
                        return response()->json(['error' => 'Insufficient fund.']);
                    }
                    
                }
                else{
                   //response when either type of account or pin is incorrecy
                   return response()->json(['error' => 'The type of account is not correct or Your Pin is incorrect.'],403);
                    
                }
            
            }
            else{
                //response when account number is invalid
              return response()->json(['error' => 'Sorry account number is not correct.Check your inputs.'],403);
            }
            
        } 
        catch(\Illuminate\Database\QueryException $ex){ 
            return json_encode($ex); 
        }

       
      
        //return a response if deposit was successful.
        return response()->json(['success' => 'You have successfully withdrawn'
           .' : '. $request->amount. ' and your current balance is ' . $new_balance],200);
        
    }
    
    }
    else{
        //response when user is not logged in
              return response()->json(['error' => 'Unauthorized.Login to access this url.'],403);
    }
  
    
   
        
    
}
