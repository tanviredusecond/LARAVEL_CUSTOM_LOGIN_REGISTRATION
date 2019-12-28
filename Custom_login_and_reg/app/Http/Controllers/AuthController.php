<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use Validator,Redirect,Response;
Use \App\User;
use Session;


class AuthController extends Controller
{
    public function index(){
        
        return view('login');
        // sending the interface for login
    }

    public function postLogin(Request $request){
        
        // take the whole login data 
        // and pass it to the validator
        //get the data
        // $data = $request->all();
        // return Response()->json($data);
        // but we will only take the email and password
        request()->validate([
            'email' => 'required',
            'password'=>'required',
        ]);
        $credential = $request->only('email','password');
        if(Auth::attempt($credential)){
            return redirect()->intended('dashboard');
        }
        return Redirect::to('login')->withSuccess('wrong Credential');
    }

    public function registration(){
        return view('registration');
    }

    public function postRegistration(Request $request){
        // add the validation
        // we pass the request with a middleware
        // called validate
        request()->validate([
            'name' =>'required',
            'email' => 'required',
            'password'=>'required| min:3',
        ]);
        // in error this will create the 
        // error array and send it to the 
        // registration.blade.php 


        $data = $request->all();
        // remember you must must hash your password
        // other wise the authentication wont work
        $user = new User;
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password =Hash::make($data['password']);
        $user->save();
        //return Response()->json($data['email']);
        //fetch all the data
        //return Response()->json($data);
        // if you do not hash your password this thing will never work
        // User::create($data);
        return Redirect::to('dashboard')->withSuccess('You are Registered');
    }

    public function dashboard(){
        return view('dashboard');
    }


    public function logout(){
        // flush the session
        Session::flush();
        Auth::logout();
        return Redirect::to('login'); 
       }
}
