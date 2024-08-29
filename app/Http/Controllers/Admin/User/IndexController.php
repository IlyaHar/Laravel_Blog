<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\User;

class IndexController extends Controller
{
    public function __invoke()
    {
        $users = User::orderBy('created_at', 'DESC')->get();

        return view('admin.users.index', compact('users'));
    }
}
