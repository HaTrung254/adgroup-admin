<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function versionone()
    {
        return view('dashboard.v1');
    }
}
