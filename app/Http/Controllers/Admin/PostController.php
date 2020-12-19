<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Topic;
use App\Models\Category;
use App\Models\User;

class PostController extends Controller
{
    public function showPost()
    {
        $post = Post::all();
        $topic = Topic::all();
        $user = User::all();
        $cate = Category::all();
        return view('dashboard.pages.admin.post.ViewPost', ['post' => $post,
            'topic' => $topic, 'user' => $user, 'cate' => $cate]);
    }

    public function getCategory($topic_id)
    {
        $categories = Category::where('topic_id', '=', $topic_id)->get();
        foreach ($categories as $category) {
            echo "<option value=" . 'all' . ">All</option>";
            echo "<option value=" . $category->id . ">" . $category->name . "</option>";
        }
    }

    public function filter(Request $request)
    {
        $topic = Topic::all();
        $user = User::all();
        /* var_dump($request->topic);
         var_dump($request->poster);
         var_dump($request->category);*/

        if ($request->topic != 'NULL' && $request->category == 'all' && $request->poster == 'NULL') {
            $posts = Post::leftJoin('tbl_category', 'tbl_category.id', '=', 'tbl_post.category_id')
                ->leftJoin('tbl_topic', 'tbl_topic.id', '=', 'tbl_category.topic_id')
                ->where('tbl_topic.id', '=', $request->topic)
                ->select('tbl_post.*')
                ->get();
            return view('dashboard.pages.admin.post.ViewPost', ['post' => $posts,
                'topic' => $topic, 'user' => $user]);
        } elseif ($request->category != 'all' && $request->poster == 'NULL') {
            $posts = Post::leftjoin('tbl_category', 'tbl_category.id', '=', 'tbl_post.category_id')
                ->where('tbl_category.id', '=', $request->category)
                ->select('tbl_post.*')
                ->get();
            return view('dashboard.pages.admin.post.ViewPost', ['post' => $posts,
                'topic' => $topic, 'user' => $user]);
            //Lấy post theo poster

        } elseif ($request->poster != 'NULL' && $request->topic == 'NULL' && $request->category != 'all') {
            $posts = Post::leftjoin('users', 'users.id', '=', 'tbl_post.author_id')
                ->where('users.id', '=', $request->poster)
                ->select('tbl_post.*')
                ->get();
            return view('dashboard.pages.admin.post.ViewPost', ['post' => $posts,
                'topic' => $topic, 'user' => $user]);
        } //Lấy post theo chủng loại và user
        elseif ($request->poster != 'NULL' && $request->topic != 'null') {
            $posts = Post::select('tbl_post.*')
                ->where('author_id', '=', $request->poster)
                ->where('category_id', '=', $request->category)
                ->get();
            return view('dashboard.pages.admin.post.ViewPost', ['post' => $posts,
                'topic' => $topic, 'user' => $user]);
        }

    }

    public function viewPost($id)
    {
        echo $id;
    }
}
