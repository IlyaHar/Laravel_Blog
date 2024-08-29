<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Carbon\Carbon;

class ShowController extends Controller
{
    public function __invoke(Post $post)
    {
        $date = Carbon::parse($post->created_at)->addHours(3);

        $relatedPosts = Post::withCount('likedUsers')->orderBy('liked_users_count', 'DESC')->where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->get()
            ->take(3);

        $comments = Comment::orderBy('created_at', 'DESC')->where('post_id', $post->id)->get();

        return view('posts.show', compact('post', 'date', 'relatedPosts', 'comments'));
    }
}
