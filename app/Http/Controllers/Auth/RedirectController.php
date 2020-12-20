<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class RedirectController extends Controller
{
    public function redirectLogin()
    {
        if (Auth::check() && Auth::user()->level == 0) {
            return redirect('/member/dashboard');
        } elseif (Auth::check() && Auth::user()->level == 1) {
            return redirect('/mod/dashboard');
        } elseif (Auth::check() && Auth::user()->level == 2) {
            return redirect('/Admin/dashboard');
        }
        return redirect('/login');
    }

    public function getAdminDashboard()
    {
        $count_all_post = Post::where('author_id', '=', Auth::id())
                ->where('is_post', '=', 1)
                ->count() ?? 0;
        return view ('dashboard.pages.admin.dashboard',['count_all_post'=>$count_all_post]);
    }
}
