<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index(){
        return "index";
    }

    public function postLogin(Request $request){
        return 'post login';
    }

    public function registration(){
        return "registration";
    }

    public function postRegistration(){
        return "post registration";
    }

    public function dashboard(){
        return "dash board";
    }


    public function logout(){
        return "logout";
    }
}
