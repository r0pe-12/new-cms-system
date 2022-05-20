<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Database\Eloquent\Casts\Attribute;
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
            'post_image'=>'mimes:png,jpg,jpeg,url',
            'body'=>'required'
        ]);

        if($file = $request->file('post_image')){
            $input['post_image'] = $file->store('images');
        }

        \Auth::user()->posts()->create($input);
        session()->flash('post-created', 'Post ' . '\'' . $request['title'] . '\'' . ' was created');
        return redirect()->route('post.index');
    }

    public function destroy(Post $post){
        # code
        $post->delete();
        session()->flash('post-deleted', "Post '$post->title' was deleted");
        return back();
    }

    public function edit(Post $post){
        # code
        return view('admin.posts.edit', ['post'=>$post]);
    }

    public function update(Post $post, Request $request){
        # code
        $input = $request->all();
        $this->validate($request, [

        ]);
        if ($file = $request->file('post_image')){
            $input['post_image']=$file->store('images');
        }
        $post->update($input);
        return redirect()->route('post.index');
    }

}
