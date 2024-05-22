<?php

namespace App\Http\Controllers;

use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\Console\Input\Input;
use DB;
use Session;

class LoginController extends Controller
{

   
    public function loginPage(){
        $records = DB::table('sessions')->get();
        return view('log',compact('records'));
    }
    public function Login(Request $request)
    {
        
        $request->validate([
            'email'    => 'required|email', // make sure the email is an actual email
            'password' => 'required|min:3' // password can only be alphanumeric and has to be greater than 3 characters
        
        ]);
       
        
            // create our user data for the authentication
            $userdata = array(
                'email'     => $request->email,
                'password'  => $request->password
            );
            // attempt to do the login
            if (Auth::attempt($userdata)) {  
                Session::put('session_id', $request->session);      
              
                return Redirect('/');
               

            } else {        
       
                // validation not successful, send back to form 
                return Redirect::to('login');
        
            }
        
    }

    public function logout()
    {
        Auth::logout(); // log the user out of our application
        return Redirect::to('login');
    }


   


}
