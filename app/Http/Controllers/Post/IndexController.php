<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;

class IndexController extends Controller
{
    public function __invoke()
    {
        $posts = Post::paginate(6);
        $randomPosts = Post::get()->random(4);
        $popularPosts = Post::withCount('likedUsers')->orderBy('liked_users_count', 'DESC')->take(3)->get();
        $newPosts = Post::orderBy('created_at', 'DESC')->take(3)->get();
        $categories = Category::all();

        return view('posts.index', compact('posts', 'randomPosts', 'popularPosts', 'newPosts', 'categories'));
    }
}
