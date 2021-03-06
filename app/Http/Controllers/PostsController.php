<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Tag;
use App\Category;
use App\Http\Requests\PostRequest;
//this for checking images when updating
use App\Http\Requests\UpdatePostRequest;
//this line for deleting images
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{

    public function  __construct() {
        $this->middleware('checkCategory')->only('create');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index')->with('posts', Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create')->with('categories', Category::all())->with('tags', Tag::all())->with('posts', Post::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        //dd($request->image->store('images','public'));



      $post = Post::create([
        'title' => $request->title,
        'description' => $request->description,
        'content' => $request->content,
        'image' => $request->image->store('images','public'),
        'category_id' => $request->categoryID




       ]);

      if($request->tags) {
        $post->tags()->attach($request->tags);
      }

        session()->flash('success', 'Utworzono');

        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.create')->with('post', $post)->with('categories', Category::all())->with('tags', Tag::all());

        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->only(['title','content','description']);

        if($request->hasFile('image')) {
            $image = $request->image->store('images','public');
            Storage::disk('public')->delete($post->image);
            $data['image'] = $image;

        }

        if($request->tags) {
            $post->tags()->sync($request->tags);
        }

        $post->update($data);

          session()->flash('success', 'Edytowano');

        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)

    {
        $post = Post::withTrashed()->where('id', $id)->first();

        if($post->trashed()) {
            //this line for deleting images
                 Storage::disk('public')->delete($post->image);
            $post->forceDelete();
        } else {
            $post->delete();
        }

        session()->flash('success', 'Usuni??to');

        return redirect(route('posts.index'));
    }


    public function trashed() {
        $trashed = Post::onlyTrashed()->get();
        return view('posts.index')->withPosts($trashed);
    }


    public function restore($id) {
        Post::withTrashed()->where('id', $id)->restore();

        session()->flash('success', 'Przywr??cono');
        return redirect(route('posts.index'));



    }
}
