<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Models\hs_access_log;
use App\Models\hs_user_account;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Stevebauman\Location\Facades\Location;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Str;
use Nette\Utils\Random;

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
    protected $redirectTo = RouteServiceProvider::HOME;

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
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'          => ['required', 'string', 'max:255'],
            'tanggal_lahir' => ['required', 'date:DD-MM-YYYY'],
            'tempat_lahir'  => ['required', 'string', 'max:255'],
            'email'         => ['required', 'string', 'email', 'max:255', 'unique:hs_user_accounts'],
            'handphone'     => ['required', 'string', 'max:255'],
            'jenis_kelamin' => ['required', 'string', 'max:255'],
            'agama'         => ['required', 'string', 'max:255'],
            'password'      => ['required', 'string', 'min:8', 'confirmed'],
            
        ]);


    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\hs_user_account
     */
    protected function create(array $data)
    {
        return hs_user_account::create([
            'name'          => $data['name'],
            'tanggal_lahir' => $data['tanggal_lahir'],
            'tempat_lahir'  => $data['tempat_lahir'],
            'email'         => $data['email'],
            'handphone'     => $data['handphone'],
            'jenis_kelamin' => $data['jenis_kelamin'],
            'agama'         => $data ['agama'],
            'password'      => Hash::make($data,['password']),
        ]);
    }


  public function userRegister(Request $request){

    $validator = Validator::make($request->all(), [
        'name'          => ['required', 'string', 'max:255'],
        'tanggal_lahir' => ['required', 'date:DD-MM-YYYY'],
        'tempat_lahir'  => ['required', 'string', 'max:255'],
        'email'         => ['required', 'string', 'email', 'max:255', 'unique:hs_user_accounts'],
        'handphone'     => ['required', 'string', 'max:255'],
        'jenis_kelamin' => ['required', 'string', 'max:255'],
        'agama'         => ['required', 'string', 'max:255'],
        'password'      => ['required', 'string', 'min:8', 'confirmed'], 
    ]);

     $user = hs_user_account::create([
        'name'          => $request->name,
        'tanggal_lahir' => $request->tanggallahir,
        'tempat_lahir'  => $request->tempatlahir,
        'email'         => $request->email,
        'handphone'     => $request->handphone,
        'jenis_kelamin' => $request->jeniskelamin,
        'agama'         => $request->agama,
        'password'      => Hash::make($request->password),
    ]);


            $ipadd = exec('getmac');
            $mac = explode(" ", $ipadd);
            $mac_address = $mac[0];

            $ipaddress = $request->ip();
            $currentUserInfo = Location::get($ipaddress);  

            $user->socialAccounts()->create([
                'mac_address' => $mac_address,
                'ip_address'  => $ipaddress,
            ]);
            $user ['password'] = Hash::make($request->password);

            return redirect()->route('login', compact('currentUserInfo')); 
     }


  public function getIpAddress(Request $request)
  { 
  
        /* $ip = $request->ip(); Dynamic IP address */
        $ip = '48.188.144.248'; /* Static IP address */
        $currentUserInfo = Location::get($ip);
        dd($currentUserInfo);
        return view('home', compact('currentUserInfo'));
     } 
}
