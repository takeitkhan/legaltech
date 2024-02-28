<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
class AuthController extends Controller
{
    public function __construct(){
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm(){
        return view('admin.auth.login');
    }

    public function login(Request $request){

        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::guard('admin')->attempt($credentials)) {
          return redirect()->intended(route('admin.index'));
        }
        return redirect()->back()->withInput($request->only('email'));
    }

    public function logout(Request $request){
            Auth::guard('admin')->logout();
            return redirect()->route('admin.login');
    }
}
