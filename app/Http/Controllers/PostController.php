<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Auth;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Http\Request;

class PostController extends Controller
{


//    home page
//    show all posts
    public function index(){
        # code
//        $posts = Auth::user()->posts()->paginate(5);
        $posts = Post::all();
        return view('admin.posts.index', ['posts'=>$posts]);
    }

//    show single post
    public function show(Post $post){
        # code
        return view('blog-post', ['post'=>$post]);
    }

//    display create post form
    public function create(){
        # code
        return view('admin.posts.create');
    }

//    store post from form data
    public function store(Request $request){
        $this->authorize('create', Post::class);

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

//    delete post
    public function destroy(Post $post){
        # code
        $post->delete();
        session()->flash('post-deleted', "Post '$post->title' was deleted");
        return back();
    }

//    show form for updating post
    public function edit(Post $post){
        # code
//        $this->authorize('view', $post);
        return view('admin.posts.edit', ['post'=>$post]);
    }

//    update form from post data
    public function update(Post $post, Request $request){
        # code
        ($this->authorize('update', $post));
        $input = $request->all();
        $this->validate($request, [
            'title'=>'required|max:255',
            'post_image'=>'mimes:png,jpg,jpeg,url',
            'body'=>'required'
        ]);
        if ($file = $request->file('post_image')){
            $input['post_image']=$file->store('images');
        }
//        $input['user_id']=Auth::user()->id;
//        dd($input);
        $post->update($input);
        session()->flash('post-updated', 'Post ' . '\'' . $request['title'] . '\'' . ' was updated');
        return redirect()->route('post.index');
    }



}
