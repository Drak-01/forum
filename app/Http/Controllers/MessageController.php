<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group; 
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
   


    public function store(Request $request, Group $group)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $group->messages()->create([
            'user_id' => Auth::id(), // 
            'content' => $request->content,
        ]);

        return back();
    }
}
