<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
    }

    public function index()
    {
        $posts = Post::paginate(25);
        return view('posts.index')->withPosts($posts);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $user = Auth::user();

        $post = $user->posts()->create([
            'title' => $request->title,
            'content' => $request->getContent(),
            'published' => $request->has('published')
        ]);

        return redirect()->route('posts.show', $post->id);
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show')->withPost($post);
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.edit')->withPost($post);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        $post = Post::findOrFail($id);
        $post->title = $request->title;
        $post->content = $request->getContent();
        $post->published = ($request->has('published') ? true : false);
        $post->save();

        return redirect()->route('posts.show', $post->id);
    }

    public function destroy($id)
    {
        Post::destroy($id);
    }
}
