<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
     public function search(Request $request)
    {
        $query = $request->input('q');
        
        $tags = Tag::where('name', 'like', '%'.$query.'%')
                 ->limit(10)
                 ->get();
        
        return response()->json($tags);
    }
}
