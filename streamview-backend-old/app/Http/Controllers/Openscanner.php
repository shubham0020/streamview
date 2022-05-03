<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Openscanner extends Controller
{
    public function index(){
        return view('admin.store.openscanner');
    }
}
