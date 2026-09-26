<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::where('status', 'PUBLISHED')->orderBy('created_at', 'desc')->paginate(9);
        $featured_posts = Post::where('status', 'PUBLISHED')->where('is_featured', 1)->orderBy('created_at', 'desc')->take(5)->get();
        return view('posts.index', compact('posts', 'featured_posts'));
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)->where('status', 'PUBLISHED')->firstOrFail();
        
        $related_posts = Post::where('status', 'PUBLISHED')
                            ->where('id', '!=', $post->id)
                            ->orderBy('created_at', 'desc')
                            ->take(3)
                            ->get();
                            
        $featured_posts = Post::where('status', 'PUBLISHED')->where('is_featured', 1)->orderBy('created_at', 'desc')->take(5)->get();
                            
        return view('posts.show', compact('post', 'related_posts', 'featured_posts'));
    }
}
