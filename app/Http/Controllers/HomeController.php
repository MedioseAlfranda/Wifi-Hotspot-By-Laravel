<?php

namespace App\Http\Controllers;

use Error;
use console;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Session;
use Stevebauman\Location\Facades\Location;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

            $mac             = session(['mac']);
            $ip              = session(['ip']);
            $linkorig        = session(['https://www.google.com']);
            $linkloginonly   = session(['link-login-only']); 
            $last_updated    = date("Y-m-d H:i:s");
            $username        = "admin";
            
            
            $ipadd           = '101.128.76.14';// request()->ip();
            $currentUserInfo = Location::get($ipadd); 
            $user            = auth()->user();
            $subs            = $user->authenticationotp;
            $chapid          = session(['chap-id']);
        
       
        return view('home')->with(compact('mac', 'ip', 'linkorig','linkloginonly', 'username','currentUserInfo','subs', 'chapid'));

        
      } 

  }
