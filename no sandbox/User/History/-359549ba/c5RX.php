<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

       public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50|unique:tags,name'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->first()
            ], 422);
        }

        $tag = Tag::create([
            'name' => $request->name,
            'color' => $this->generateRandomColor()
        ]);

        return response()->json($tag);
    }

    private function generateRandomColor()
    {
        // Liste de couleurs prédéfinies pour une cohérence visuelle
        $colors = [
            '#3b82f6', // bleu
            '#ef4444', // rouge
            '#10b981', // vert
            '#f59e0b', // jaune
            '#8b5cf6', // violet
            '#ec4899', // rose
            '#14b8a6', // turquoise
            '#f97316'  // orange
        ];
        
        return $colors[array_rand($colors)];
    }
}
