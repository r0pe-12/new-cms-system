<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function show(Post $post){
        # code
        return view('blog-post', ['post'=>$post]);
    }

    public function create(){
        # code
        return view('admin.posts.create');
    }

    public function store(){
        # code
        ddd(\request()->all());
    }
}
