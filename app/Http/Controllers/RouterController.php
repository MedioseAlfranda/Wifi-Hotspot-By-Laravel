<?php

namespace App\Http\Controllers;

use auth;
use Exception;
use App\Models\hs_auth_otp;
use PEAR2\Net\RouterOS\Client;


use App\Models\hs_user_account;
use PEAR2\Net\RouterOS\Request;
use PEAR2\Net\RouterOS\Response;
use Stevebauman\Location\Facades\Location;


class RouterController extends Controller
{
   
   public function connecttoWifi(){
        $mac = exec('getmac');
        $ip = exec('ip');
        $linkorig = exec("https://portal.astiisb.com/thankyou.html");
        $linkloginonly = exec('linkloginonly');
        
        $last_updated = date("Y-m-d H:i:s");
    
        $username="admin";
        $ip = '101.128.76.14'; /* Static IP address */ //request()->ip();
        $currentUserInfo = Location::get($ip); 
        $user = auth()->user();
        $subs = $user->authenticationotp;
        $chapid = exec('chap-id');
       
        return view('home')->with(compact('mac', 'ip', 'linkorig','linkloginonly', 'username','currentUserInfo','subs', 'chapid'));

}

    public function subscription(){
        //return register user ke paket
        try {
            $ipbase  = env('ROUTER_IP');
            $userip  = env('ROUTER_USER');
            $pass    = env('ROUTER_PASS');
            $client  = new Client($ipbase, $userip, $pass);

           $amount             = 5;
            $plan2              = 'Hotspot';
            $user               = auth()->user();
            $email              = $user->email;
            $password           = $user->password;
            $formatted_email    = str_replace('','', $email);
            $formatted_password = str_replace('','', $password);
            $add_user           = new Request('/tool/usermanager/user/add');

           $client->sendSync(
               $add_user
                ->setArgument('customer','admin')
                ->setArgument('disabled', 'no')
                ->setArgument('username', $formatted_email)
                ->setArgument('password', $formatted_email)
                ->setArgument('shared-users', 1)
            );
           
            $activate_profile = new Request('/tool user-manager user create-and-activate-profile');
            $client->sendSync(
                $activate_profile
                ->setArgument('customer', 'admin')
                ->setArgument('profile', $plan2)
                ->setArgument('numbers', $formatted_email)
            );

            $authen = hs_auth_otp::where('package', $plan2)->where('user_id', auth()->id())->where('status', 1)->first();
                if(!$authen){
                    $authentication             = new hs_auth_otp();   
                    $authentication->username   = $formatted_email;
                    $authentication->password   = $formatted_email;
                    $authentication->user_id    = auth()->id();
                    $authentication->package    = $plan2;
                    $authentication->status     = 1;
                    $authentication->amount     = $amount;
                    $authentication->save();
                }
                dd($add_user); 
            return redirect('home'); 
        }catch (Exception $e) {
            throw $e;
            //die('Unable to connect to the router.');
            //Inspect $e if you want to know details about the failure.
         }
       }
       

    public function hotspotUsers(){
                $ipbase  = env('ROUTER_IP');
                $userip  = env('ROUTER_USER');
                $pass    = env('ROUTER_PASS');
                $client  = new Client($ipbase, $userip, $pass);
                $activate_profile = new Request('/tool user-manager user profile');   
                $users_Hotspot = $client->sendSync($activate_profile);
             
                dd($users_Hotspot);
       }

} 




