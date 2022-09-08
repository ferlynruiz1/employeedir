<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function test()
    {
        $today = now();
            $today->month = 1;
            $today->day = 1;
            $thisYear = $today;
        dd($today->format('Y-m-d'));
    }
}
