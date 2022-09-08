<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test()
    {
        $user = new User();
        dd($user->generalManager());
    }
}
