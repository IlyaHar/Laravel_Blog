<?php

namespace App\Http\Controllers\Personal\Settings;

use App\Http\Controllers\Controller;

class EditController extends Controller
{
    public function __invoke()
    {
        return view('personal.settings.edit');
    }
}
