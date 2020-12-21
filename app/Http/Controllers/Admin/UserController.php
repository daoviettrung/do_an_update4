<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
class UserController extends Controller{
    public function viewUser(){
        $user = User::all();
        return view('dashboard.pages.admin.user.view', [ 'user' => $user]);
    }

    public function getEdit($idU){
        $idU=DB::table('users')->where('id',$idU)->get();
        foreach ($idU as $u){
            $u=$u;
        }
        return view('dashboard.pages.admin.user.edit',['user'=>$u]);
    }
    public function postEdit(Request $request,$idU){
        $validator = $request->validate(['name' => 'required|min:2|max:250'], ['name.required' => 'Do not leave it blank',
            'name.min' => 'Need to enter 2 or more characters', 'name.max' => 'The number of characters exceeds the limit']);
        $idU=DB::table('users')->where('id',$idU)->get();
        foreach ($idU as $u){
            $u=$u;
        }
        $name=$request->name;
        $name= explode(" ",$name);
        $user=User::find($u->id);
        $user->name=$request->name;
        $user->email=$request->email;
        $user->gender = $request->gender;
        $user->level = $request->level;
        $user->save();
        return $this->viewUser();

    }
    public function delete($idU){
        $idU=DB::table('users')->where('id',$idU)->get();
        foreach ($idU as $u){
            $u=$u;
        }
        $post=DB::table('tbl_post')->where('author_id',$u->id)->get();
        foreach ($post as $p){
            $p_delete= Post::find($p->id);
            $p_delete->delete();
        }
        $user = User::find($u->id);
        $user->delete();
        return $this->viewUser();
    }
    public function viewPost($id){
        $posts=Post::select('tbl_post.*')->where('author_id','=',$id)->get();
        $topic = Topic::all();
        $user = User::all();
        $cate = Category::all();
        return view('dashboard.pages.admin.post.post-i-manage', ['post' => $posts,
            'topic' => $topic, 'user' => $user, 'cate' => $cate]);
    }
    /* public function getAddUser()
 {
     return view('dashboard.pages.admin.user.add');
 }
 public function postAddUser(Request $request)
 {
     $validator = $request->validate(['name' => 'required|min:2|max:250', 'password' => 'required|min:5|max:30'], ['name.required' => 'Do not leave it blank',
         'name.min' => 'Need to enter 2 or more characters', 'name.max' => 'The number of characters exceeds the limit', 'password.required' => 'Do not leave it blank',
         'password.min' => 'Need to enter 5 or more characters', 'password.max' => 'The number of characters exceeds the limit']);
     $user = new User;
     $user->name=$request->name;
     $user->email=$request->email;
     $user->gender=$request->gender;
     $user->level=$request->level;
     $user->password=Hash::make($request->password);
     $user->save();
     session()->flash('success', 'Created successfully');
     return view('dashboard.pages.admin.user.add');
 }*/
}
