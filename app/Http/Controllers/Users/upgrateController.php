<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\PackagePlan;
use Illuminate\Http\Request;

class upgrateController extends Controller
{
    public function upgrade(){
    $packages = PackagePlan::all();
        return view('users.upgrade',compact('packages'));
    }
}
