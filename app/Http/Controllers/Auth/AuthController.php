<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
//use Illuminate\Support\Facades\Auth;
use Cookie;
use Mail;
use Session;
use Redirect;
use DB;
class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

  //  use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
   // protected $redirectTo = '/tasks';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
		$sessionData=Session::get('is_login');
		 if($sessionData=='true')
			{
				Redirect::to('dashboard')->send();
			}
		
    }

    public function check()
    {
        return view('auth.loginsample');
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function saveRegister(array $data)
    {
		$token=$this->fnEncrypt($data['email'],env('API_PASSWORD', false));
         User::create([
            'fullName' => $data['fullname'],
            'email' => $data['email'],
			'status' => '1',
			'api_token' => $token,
            'password' => bcrypt($data['password']),
        ]);
		
		

    }
	public function showLoginForm()
	{
		return view('auth.login');
	}
	public function login(Request $request)
	{	
		$request->session()->forget('invalidLogin');
		$v=Validator::make($request->all(), [
            'email' => 'required|email|max:255',
            'password' => 'required|min:6',
        ]);
		if ($v->fails())
		{		

			return redirect()->back()->withErrors($v->errors());
		}
		$data=$request->all();
		
		//dd($data);
		
		$remember_me = $request->has('remember') ? true : false; 

		
		   if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            // Authentication passed...
			   
	    $user = DB::table('users')->where('email', $data['email'])->first();
			   
			   if($remember_me) {
				setcookie('member_login', $data['email'], time()+ (10 * 365 * 24 * 60 * 60));
				setcookie('member_password', $data['password'], time()+ (10 * 365 * 24 * 60 * 60));

				//setcookie ("member_login",$_POST["member_name"],time()+ (10 * 365 * 24 * 60 * 60));
				//setcookie ("member_password",$_POST["member_password"],time()+ (10 * 365 * 24 * 60 * 60));
			}
			   
			  // print_r($user->userId);die;
		   
		session(['is_login' => true]);
	    session(['userId' => $user->id]);
		session(['email' => $data['email']]);
            return redirect()->intended('dashboard');
        }
		$request->session()->flash('invalidLogin', 'Invalid Username and Password.');
		return redirect()->back();
		
	}
	
	public function resetpassword(Request $request)
	{	
		$request->session()->forget('invalidLogin');
		$v=Validator::make($request->all(), [
            'email' => 'required|email|max:255',
        ]);
		if ($v->fails())
		{		

			return redirect()->back()->withErrors($v->errors());
		}
		$data=$request->all();

	    $user = DB::table('users')->where('email', $data['email'])->first();
			   
		if($user) {
			
			$resetPassword=rand(100000000,10000000);
			
			DB::table('users')
            ->where('email', $data['email'])
            ->update(array('password' => bcrypt($resetPassword)));
			
			 Mail::send('emails.resetpassword', ['password' => $resetPassword], function ($m) use ($user) {
            $m->from('hello@app.com', 'Your Application');

            $m->to($user->email, $user->firstName)->subject('Your Reminder!');
        });
			
			$request->session()->flash('successemail', 'The password has sent to your registered email.');
		}
		else
		{
			$request->session()->flash('invalidemail', 'Invalid Email.');

		}
			   	
		return redirect()->back();
		
	}
	
	
	public function showRegistrationForm()
	{
		return view('auth.register');
		
	}
	function showForGetPassword()
	{
	   return view('auth.reset');	
	}
	
	public function registeruser(Request $request)
	{
		$v=Validator::make($request->all(), [
            'fullname' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
		if ($v->fails())
		{		

			return redirect()->back()->withErrors($v->errors());
		}


		$this->saveRegister($request->all());
		$data=$request->all();
		
		 $user = DB::table('users')->where('email', $data['email'])->first();
			   
			  // print_r($user->userId);die;
		   
		session(['is_login' => true]);
	    session(['userId' => $user->userId]);
		
		
		
		//$indexNumberStart=100000;
		
		//session(['is_login' => true]);
		session(['email' => $data['email']]);
		//$this->createOssIndex($indexNumberStart+$user->userId);
		Redirect::to('dashboard')->send();

		
	}
	
	
    

function fnEncrypt($sValue, $sSecretKey)
{
    return rtrim(
        base64_encode(
            mcrypt_encrypt(
                MCRYPT_RIJNDAEL_256,
                $sSecretKey, $sValue, 
                MCRYPT_MODE_ECB, 
                mcrypt_create_iv(
                    mcrypt_get_iv_size(
                        MCRYPT_RIJNDAEL_256, 
                        MCRYPT_MODE_ECB
                    ), 
                    MCRYPT_RAND)
                )
            ), "\0"
        );
}

function fnDecrypt($sValue, $sSecretKey)
{
    return rtrim(
        mcrypt_decrypt(
            MCRYPT_RIJNDAEL_256, 
            $sSecretKey, 
            base64_decode($sValue), 
            MCRYPT_MODE_ECB,
            mcrypt_create_iv(
                mcrypt_get_iv_size(
                    MCRYPT_RIJNDAEL_256,
                    MCRYPT_MODE_ECB
                ), 
                MCRYPT_RAND
            )
        ), "\0"
    );
}
	

}
