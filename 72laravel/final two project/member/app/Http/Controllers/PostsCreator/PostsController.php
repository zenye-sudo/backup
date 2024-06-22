<?php

namespace App\Http\Controllers\PostsCreator;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostsInsertRequestForm;
use Illuminate\Support\Facades\Auth;
use App\Post;
class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=Post::all();
        return view('backend.posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::all();
        $user=Auth::user();
        return view('backend.posts.create',compact("categories","user"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsInsertRequestForm $request)
    {
        $slug=uniqid();
        Post::create([
            'title'=>$request->get('title'),
            'content'=>$request->get('content'),
            "user_id"=>$request->get('user_id'),
            "cat_id"=>$request->get('cat_id'),
            'slug'=>$slug
        ]);
    return redirect('/postsCreator/posts/create')->with('status','Successfully insert post');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post=Post::whereId($id)->firstOrFail();
        return view('backend.posts.show',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post=Post::whereId($id)->firstOrFail();
        $categories=Category::all();
        return view('backend.posts.edit',compact('post','categories'));
    }
    public function edit1(PostsInsertRequestForm $request,$id)
    {
        $post=Post::whereId($id)->firstOrFail();
        $post->title=$request->get('title');
        $post->content=$request->get('content');
        $post->cat_id=$request->get('cat_id');
        $post->update();
        return redirect(action('postsCreator\PostsController@edit1',$id))->with('status',"Successfully update posts");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
