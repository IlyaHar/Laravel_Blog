<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Services\PostService;

class BaseController extends Controller
{
    public function __construct(public PostService $service) {}
}
