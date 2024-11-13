<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontHomeController extends Controller
{
    protected function home(){
        return view('front.home');
    }
    protected function showFrontSignInForm(){
        return view('front.login');
    }
    protected function showFrontRegistrationForm(){
        return view('front.register');
    }
}
