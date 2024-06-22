<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;

class IndexController extends Controller
{
    public function __invoke()
    {
        $categories = Category::orderBy('created_at', 'DESC')->get();

        return view('admin.categories.index', compact('categories'));
    }
}
