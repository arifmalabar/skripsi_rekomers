<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('login.login');
    }

    public function login_proses(request $request){
        $request->validate([
            'username'  => 'required',
            'password'  => 'required',
        ]);

        $data = [
            'username'  => $request->username,
            'password'  => $request->password
        ];
        if(Auth::guard("teachers")->attempt($data)){
            $request->session()->regenerate();
            $role = Auth::guard("teachers")->user()->role;
            if($role == "kakomli"){
                return redirect()->route("dashboard");
            } else {
                return redirect()->route("/teacher/dashboard");
            }
        } else{
            return redirect("/");
        }
    }

    public function logout(){
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();
        
        return redirect()->route('login')->with('succes', 'Berhasil Logout');
    }
}
