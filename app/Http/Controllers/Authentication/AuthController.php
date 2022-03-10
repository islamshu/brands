<?php

namespace App\Http\Controllers\Authentication;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\userReset;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

 use Response;
 

 use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function getLogin()
    {
       
    	return view('dashboard.auth.login');
    }

    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    // }
   
    public function postLogin(Request $request)
    {
        $data=$request->except(array('_token'));
        $rule=array(         
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6|max:20', 
            );       
        if(app()->getLocale() == "en")
        {
            $messages=array(
                'email.required' =>  'please enter your Email',
                'email.email' => 'please enter A Valid Email',
                'email.email' => 'This Email Not Exist',
                'password.required' => 'please enter a password',
                'password.min' => 'the minimum value is 6 character',
                'password.max' => 'the maximum value is 20 character',            
                );
        }
        elseif(app()->getLocale() == "ar")
        {
            $messages=array(
                'email.required' => 'please enter your email',
                'email.email' => 'please enter A Valid Email',
                'email.email' => 'This Email Not Exist',
                'password.required' => 'please enter a password',
                'password.min' => 'the minimum value is 6 character',
                'password.max' => 'the maximum value is 20 character',
                );            
        }              
        $validator=Validator::make($data,$rule,$messages);
        if ($validator->fails()) 
        {
            // dd('sdv');
            return Redirect::route('dashboard.auth.login',['locale'=>app()->getLocale()])->withErrors($validator)->withInput();
        }
        else
        {
            if(Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
            {
                dd(Auth::user()->hasRole('Vendors'));
                 if(Auth::user()->hasRole('Vendors')){
                    return Redirect::route('home.index',['locale'=>app()->getLocale()]);
                 }

                 return Redirect::route('dashboard.auth.login',['locale'=>app()->getLocale()]);
            }
            else
            {
                return Redirect::route('dashboard.auth.login',['locale'=>app()->getLocale()]);
            }        
        }     	
    }
     public function logout()
    {
        Auth::logout();
        return redirect()->route('get_login');
    }

    public function getResetPassword()
    {
        return view('dashboard.auth.reset_password');
    }

    public function postResetPassword(Request $request)
    {
       $data=$request->except(array('_token'));
        $rule=array(         
            'email' => 'required|email|exists:users,email',
            );       
        if(app()->getLocale() == "en")
        {
            $messages=array(
                'email.required' =>  'please enter your Email',
                'email.email' => 'please enter A Valid Email',
                'email.exists' => 'This Email Not Exist',           
                );
        }
        elseif(app()->getLocale() == "ar")
        {
            $messages=array(
                'email.required' => 'please enter your email',
                'email.email' => 'please enter A Valid Email',
                'email.exists' => 'This Email Not Exist',
                );            
        }          

        $validator=Validator::make($data,$rule,$messages);
        if ($validator->fails()) 
        {
            return Redirect::route('dashboard.auth.reset_password',['locale'=>app()->getLocale()])->withErrors($validator)->withInput();
        }
        else
        {
            $user = User::where('email',$request->email)->first();
            //create password 
            $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
            $pass = array(); 
            $alphaLength = strlen($alphabet) - 1;
            for ($i = 0; $i < 8; $i++) {
                $n = rand(0, $alphaLength);
                $pass[] = $alphabet[$n];
            }
            $new_password=implode($pass);
            $user->password = bcrypt($new_password);
            $user->save();

            //send by email
            $data =array(
                          'password'=>$new_password,
                        );
            Mail::send('dashboard.emails.forgot_password', $data, function ($message) use ($user){
                    $message->from('mennaelattar3@gmail.com', 'YalaGo Forgot Password');
                    $message->to($user->email, $user->username)->subject('YalaGo Forgot Password');
                });
            return redirect()->route('dashboard.auth.login',['locale'=>app()->getLocale()]);
        }

            
    }
    public function requestNewPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|exists:users,email|email',
        ], ['email.exists' => 'This is email is not registered before']);

        $newPassword = Str::random(8);

        $admin = User::where('email', $request->get('email'))->first();
        $admin->password = Hash::make($newPassword);
        $isSaved = $admin->save();
        if ($isSaved) {
            $this->sendResetPasswordEmail($admin, $newPassword);
            return redirect(url('/en/dashboard/login'));
                } else {
            return false;
        }
    }
    public function showResetPasswordView()
    {
        return view('dashboard.auth.reset_password_dash');
    }
    public function resetPassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string|password:web',
            'new_password' => 'required|string',
            'new_password_confirmation' => 'required|string|same:new_password'
        ], ['current_password.password' => 'Your current password is not correct']);

        $user = Auth::user();
         $user->password = Hash::make($request->get('new_password'));
        $isSaved = $user->save();
        if ($isSaved) {
            return response()->json(['icon' => 'success', 'title' => 'Password changed successfully'], 200);
        } else {
            return response()->json(['icon' => 'success', 'title' => 'Password change failed!'], 400);
        }
    }
    private function sendResetPasswordEmail(User $admin, $newPassword)
    {
        Mail::queue(new userReset($admin, $newPassword));
    }
    public function getLogout(Request $request)
    {
        Auth::logout();
        return Redirect::route('dashboard.auth.login',app()->getLocale());
    } 
}
