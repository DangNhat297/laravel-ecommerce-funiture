<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    
    public function index()
    {
        $posts = Post::with('author')->paginate(6);
        return view('screen.client.blog-list', compact('posts'));
    }

    public function show($slug, $id)
    {
        $post = Post::with('author')
                    ->where('slug', $slug)
                    ->where('id', $id)
                    ->first();
        if(!$post || $post->published == 0) abort(404);
        return view('screen.client.blog-detail', compact('post'));
        
    }

}
