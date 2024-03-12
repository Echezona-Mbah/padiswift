<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(){
        // $auth = auth()->user()->id;
        // dd($auth);die();
        return view('users.home');
    }
}
