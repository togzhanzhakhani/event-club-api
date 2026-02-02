<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('category')
                ->orderByDesc('created_at')->get();
        return PostResource::collection($posts);
    }

    public function show(Post $post)
    {
        $post->incrementViews();
        return new PostResource($post);
    }
}
