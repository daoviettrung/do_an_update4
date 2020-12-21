<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    function to_id($slug)
    {
        $arr = explode('-', $slug);
        $id = "";
        foreach ($arr as $v) {
            $id .= substr($v, 0, 1);
        }
        return strtoupper($id);
    }

    public function getCategory($topic_id)
    {
        $categories = Category::where('topic_id', '=', $topic_id)->get();
        echo "<option value=" . 'all' . ">   </option>";
        foreach ($categories as $category) {
            echo "<option value=" . $category->id . ">" . $category->name . "</option>";
        }
    }

    public function filter(Request $request)
    {
        $topic = Topic::all();
        $user = User::all();
        if ($request->topic != 'NULL' && $request->category == 'all') {
            $posts = Post::leftJoin('tbl_category', 'tbl_category.id', '=', 'tbl_post.category_id')
                ->leftJoin('tbl_topic', 'tbl_topic.id', '=', 'tbl_category.topic_id')
                ->where('tbl_topic.id', '=', $request->topic)
                ->select('tbl_post.*')
                ->get();
            return view('dashboard.pages.admin.post.post-i-manage', ['post' => $posts,
                'topic' => $topic, 'user' => $user]);
        } elseif ($request->category != 'all') {
            $posts = Post::leftjoin('tbl_category', 'tbl_category.id', '=', 'tbl_post.category_id')
                ->where('tbl_category.id', '=', $request->category)
                ->select('tbl_post.*')
                ->get();
            return view('dashboard.pages.admin.post.post-i-manage', ['post' => $posts,
                'topic' => $topic, 'user' => $user]);
            //Lấy post theo poster

        } elseif ($request->topic == 'NULL' && $request->category == 'all') {
            $posts = Post::all();
            return view('dashboard.pages.admin.post.post-i-manage', ['post' => $posts,
                'topic' => $topic, 'user' => $user]);
        }
    }

    public function getMyPost()
    {
        $posts = Post::where('author_id', '=', Auth::id())
            ->where('is_post', '=', true)
            ->latest()
            ->get();
        return view('dashboard.pages.admin.post.my-post', ['posts' => $posts]);
    }

    public function showPost()
    {
        $topicFirst=DB::table('tbl_topic')->first();
        $posts = Post::leftJoin('tbl_category', 'tbl_category.id', '=', 'tbl_post.category_id')
            ->leftJoin('tbl_topic', 'tbl_topic.id', '=', 'tbl_category.topic_id')
            ->where('tbl_topic.id', '=', $topicFirst->id)
            ->select('tbl_post.*')
            ->get();
        $topic = Topic::all();
        $user = User::all();
        $cate = Category::all();
        return view('dashboard.pages.admin.post.post-i-manage', ['post' => $posts,
            'topic' => $topic, 'user' => $user, 'cate' => $cate]);
    }
    public function getAddPost()
    {
        $topics = Topic::all();
        return view('dashboard.pages.admin.post.add', ['topics' => $topics]);
    }
    public function postAddPost(Request $request)
    {
        $request->validate([
            'title' => 'max:255',
            'slug' => 'unique:tbl_post|max:255',
            '_content' => 'required',
        ]);
        $post = new Post();
        $post->author_id = Auth::id();
        $post->category_id = $request->category_id;
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post_latest = Post::where('is_post', '=', true)
            ->latest()
            ->first();
        if ($post_latest) {
            $index = (int)explode('-', $post_latest->id)[1] + 1;
            $post_id = $this->to_id($post->slug) . '-' . $index;
        } else {
            $post_id = $this->to_id($post->slug) . '-1';
        }
        $post->id = $post_id;
        $post->content = $request->_content;
        if ($post->category->topic->mod_id == $post->author_id || Auth::user()->level == 2) {
            $post->status = 'display';
        } else {
            $post->status = 'approval';
        }
        $post->is_post = true;
        $post->save();
        return redirect('admin/ManagePost/list/my-post')
            ->with('status', 'Post successfully created!');
    }


}
