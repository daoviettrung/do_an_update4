<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Mod\ModControllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\Admin\PostController;

class AuthController extends Controller
{
    public function login(){
        return view('auth.login');
    }
    public function checkLogin(Request $request){
        $admin= new RedirectController();
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $credentials = DB::table('users')->where('email', $request->email)->get();
            foreach($credentials as $values){
                $values=$values;

            }
            return $admin->getAdminDashboard();
        }
        else{
            return view('auth.login');
        }
    }

}
