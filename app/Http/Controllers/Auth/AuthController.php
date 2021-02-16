<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function login(){
        return view('auth.login');
    }
    public function checkLogin(Request $request){
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $auth=User::find(Auth::user()->id);
            if($auth->isBan==0){
                return redirect('admin/dashboard');
            }
            $auth=explode("/",$auth->isBan);
            $dateNow=getdate();
            if($auth[2]>$dateNow['year']){
                $auth=implode("-",$auth);
                session()->flash('ban', 'Account is banned until date '.$auth);
                return view('auth.login');
            }
            if($auth[2]==$dateNow['year']){
                if($auth[1]>$dateNow['mon']){
                    $auth=implode("-",$auth);
                    session()->flash('ban', 'Account is banned until date '.$auth);
                    return view('auth.login');
                }
                if($auth[1]==$dateNow['mon']){
                    if($auth[0]>$dateNow['mday']||$auth[0]==$dateNow['mday']){
                        $auth=implode("-",$auth);
                        session()->flash('ban', 'Account is banned until date '.$auth);
                        return view('auth.login');
                    }
                }
            }
        }
        else{
            return view('auth.login');
        }
    }

}
