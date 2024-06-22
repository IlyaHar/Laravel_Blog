<?php

namespace App\Http\Controllers\Admin\Post;

use App\Models\Post;

class IndexController extends BaseController
{
    public function __invoke()
    {
        $posts = Post::orderBy('created_at', 'DESC')->get();

        return view('admin.posts.index', compact('posts'));
    }
}
