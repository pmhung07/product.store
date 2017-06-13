<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Http\Requests;
use App\User;

class LoginController extends Controller
{
    public function getLogin()
    {
        if(Auth::guest())
        {
            return view('admin.login');
        }else{
            return redirect()->route('admin.dashboard');
        }
        
    }

    public function postLogin(Request $request)
    {
        $login = [
            'email' => $request->email, 
            'password' => $request->password
        ];
        if (Auth::attempt($login)) {
            return redirect()->route('admin.welcome');
        } else{
            return redirect()->back();
        }
    }

    public function getLogout(){
        Auth::logout();
        return redirect('auth/login');
    }
}
