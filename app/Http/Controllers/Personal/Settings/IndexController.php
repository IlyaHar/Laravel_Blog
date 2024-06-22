<?php

namespace App\Http\Controllers\Personal\Settings;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function __invoke()
    {
        return redirect()->route('personal.settings.edit');
    }
}
