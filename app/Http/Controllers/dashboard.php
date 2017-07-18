<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class dashboard extends Controller
{
    public function welcome(){
    	return view('dashboard/index');
    }
}
