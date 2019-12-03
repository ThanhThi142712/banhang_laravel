<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function getindex(){
    	 return view('admin');

    }

    public function getquantri(){
    	 return view('backend.dashboard');

    }

}
