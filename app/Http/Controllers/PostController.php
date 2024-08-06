<?php

namespace App\Http\Controllers;
use App;
use App\Models\Category;
use App\Models\Post;

use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
       $posts= Post::all();
        return view('main.index',['posts'=>$posts]);
    }

    public function create(){
        
       $categories= Category::select('id','namecat')->get();
        return view('posts.create',['categories'=>$categories]);
    }

    public function store(Request $request){
        $request->validate([
            'title'=>'required|string | max:100',
            'desc'=>'required | string',
            'img'=>'required | image | mimes:jpg,png',
            'categries_ids'=>'required',
            'categries_ids.*'=>'exists:categories,id'

        ]);


        $title=$request->title;
        $desc=$request->desc;

        $img=$request->file('img');
        $txt=$img->getClientOriginalExtension();
        $nameimg='post-'.uniqid().$txt;
        $img->move(public_path('uploads\posts'),$nameimg);
       $post= Post::create([
            'title'=>$title,
            'desc'=>$desc,
            'img'=>$nameimg,
            'user_id'=>Auth::user()->id
        ]);

        $post->categories()->sync($request->categries_ids);

        return redirect()->route('posts.index');
    }

    public function show($id){

        $post = Post::with('users')->findOrFail($id);
        
        return view('posts.show', ['post' => $post]);
    }

    public function edit($id){
        $post=Post::findOrFail($id);
        return view('posts.edit',['post'=>$post]);
    }
    public function updatee(Request $request, $id)
{
    // Retrieve the post by ID
    $post = Post::findOrFail($id);

    // Check if the authenticated user is the owner of the post
    if ($post->user_id != Auth::id()) {
        return redirect()->route('posts.index')->with('alert', 'You are not authorized to edit this post.');
    }

    // Validate and update the post
    $request->validate([
        'title' => 'required|string|max:100',
        'desc' => 'required|string',
    ]);

    $post->update([
        'title' => $request->title,
        'desc' => $request->desc,
    ]);

    // Redirect with success message
    return redirect()->route('posts.index')->with('success', 'Post updated successfully');
}

       public function delete($id)
    {
        $post = Post::findOrFail($id);

        if ($post->user_id != Auth::id()) {
            return redirect()->route('posts.index')->with('alert', 'You are not authorized to delete this post.');
        }

        $post->categories()->detach();

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully');
    }


       public function search(Request $request){
        $keyword=$request->keyword;
        $post=Post::where('title','like',"%$keyword%")->get();
        return response()->json($post);
       }


       public function myposts()
       {
           $posts = Auth::user()->posts;
       
           return view('posts.myposts',['posts'=>$posts]);
       }   
}
