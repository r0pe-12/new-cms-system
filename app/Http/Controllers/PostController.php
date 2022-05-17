<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //

    public function index(){
        # code
        $posts = Post::all();
        return view('admin.posts.index', ['posts'=>$posts]);
    }

    public function show(Post $post){
        # code
        return view('blog-post', ['post'=>$post]);
    }

    public function create(){
        # code
        return view('admin.posts.create');
    }

    public function store(Request $request){
        $input = $request->all();
        $this->validate($request, [
           'title'=>'required|max:255',
            'post_image'=>'mimes:png,jpg,jpeg',
            'body'=>'required'
        ]);

//        dd($input);
        if($file = $request->file('post_image')){
//            $name = $file->getClientOriginalName();
//            $file->store('images');
            $input['post_image'] = $file->store('images');
        }

        \Auth::user()->posts()->create($input);
        return back();
    }

}
