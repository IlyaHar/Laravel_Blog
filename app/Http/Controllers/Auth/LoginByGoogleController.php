<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\GoogleService;

class LoginByGoogleController extends Controller
{
    public function __invoke(GoogleService $service)
    {
        $service->login();
        return redirect()->route('personal.index');
    }
}
