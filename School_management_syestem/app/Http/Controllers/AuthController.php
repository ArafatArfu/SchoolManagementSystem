<?php

namespace App\Http\Controllers;
use Auth;
use App\Mail\ForgotPasswordMail;
use Mail;
use Str;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Queue\RedisQueue;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
class AuthController extends Controller
{
    public function login()
    {   
        // dd(Hash::make(123456));
        if(!empty(Auth::check()))
        {
            if(Auth::user()->user_type == 1)
            {
                return redirect('admin/dashboard');
            }
            else if(Auth::user()->user_type == 2)
            {
                return redirect('teacher/dashboard');
            }
            else if(Auth::user()->user_type == 3)
            {
                return redirect('student/dashboard');
            }
            else if(Auth::user()->user_type == 4)
            {
                return redirect('parent/dashboard');
            }
        }
        return view('auth.login');
    }
    
    public function AuthLogin(Request $request)
    {
        $remember = !empty($request->remember) ? true : false;
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password],$remember))
        {
            if(Auth::user()->user_type == 1)
            {
                return redirect('admin/dashboard');
            }
            else if(Auth::user()->user_type == 2)
            {
                return redirect('teacher/dashboard');
            }
            else if(Auth::user()->user_type == 3)
            {
                return redirect('student/dashboard');
            }
            else if(Auth::user()->user_type == 4)
            {
                return redirect('parent/dashboard');
            }
        }
        else
        {
            return redirect()->back()->with('error','Please enter currect email and Password');
        }
    }

    public function forgotpassword(Request $request)
    {
        return view('auth.forgot');
    }


    public function PostForgetPassword(Request $request)
    {
        $user = User::getEmailSingle($request->email);
        if(!empty($user))
        {
            $user->remember_token = Str::random(30);
            $user->save();

            Mail::to($user->email)->send(new ForgotPasswordMail($user));

            return redirect()->back()->with('success', "Please check your email and reset your Password");
        }
        else
        {
            return redirect()->back()->with('error', "Email not found in this System");
        }
    }

    

    public function reset($remember_token)
    {
        $user = User::getTokenSingle($remember_token);
        if(!empty($user))
        {
            $data['user'] = $user;
            return view('auth.reset', $data);
        }
        else
        {
             abort(404);
        }
    }


    public function  PostReset($remember_token, Request $request)
    {
        if($request->password == $request->cpassword)
        {
            $user = User::getTokenSingle($remember_token);
            $user->password = Hash::make($request->password);
            $user->remember_token = Str::random(30);
            $user->save();

            return redirect('/')->with('success',"Password successfully reset");
        }
        else
        {
            return redirect()->back()->with('error',"Password and confirm password does not match");
        }
    }


    

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect(url(''));
    }
}
