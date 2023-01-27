<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //creo una variabile per recuperare il record dell'utente loggato

        // $userId = Auth::id();
        // $user = Auth::user();

        // $posts = Post::All();
        // $posts = Post::with('categories')->get();
        // $category = Category::All();
        // $data = [
        $data = [
            'posts' => Post::with('category')->get()
            // 'categories' => Category::All()
        ];

        return view('admin.post.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::All();

        return view('admin.post.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $posts = $request->all();
        $new_post = new Post();
        $new_post->fill($posts);
        $new_post->save();

        return redirect()->route('admin.post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $posts = Post::findOrFail($id);
        return view('admin.post.show', compact('posts'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::All();

        return view('admin.post.edit', compact('post', 'categories'));
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
        $data = $request->all();
        $posts = Post::findOrFail($id);

        $posts->update($data);
        return redirect()->route('admin.post.index', $posts->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $posts = Post::findOrFail($id);
        $posts->delete();
        return redirect()->route('admin.post.index');
    }
}
