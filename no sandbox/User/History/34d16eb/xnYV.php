<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GroupController extends Controller
{
    function index()
    {
        return view('groups.index');
        
    }
}
