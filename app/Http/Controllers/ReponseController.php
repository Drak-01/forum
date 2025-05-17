<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Reponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReponseController extends Controller
{
    public function store(Request $request, Question $question)
    {
        $validated = $request->validate([
            'content' => 'required|string|min:10|max:5000',
            'description' => 'nullable|string|max:1000',
        ]);

        $reponse = $question->reponses()->create([
            'content' => $validated['content'],
            'description' => $validated['description'],
            'datePost' => now(),
            'contentType' => 'text', // ou selon votre logique
            'user_id' => Auth::id()
        ]);

        return back()->with('success', 'Réponse publiée!');
    }

    public function show(Reponse $reponse)
    {
        // Vérifie que l'utilisateur est bien l'auteur
        if ($reponse->user_id !== auth()->id()) {
            abort(403);
        }
    
        $reponse->load(['question.user', 'question.tags', 'votes']);
        
        return view('users.reponse.show', compact('reponse'));
    }
    
    public function update(Request $request, Reponse $reponse)
    {
        $validated = $request->validate([
            'content' => 'required|string|min:10',
            'description' => 'nullable|string'
        ]);
    
        $reponse->update($validated);
        
        return back()->with('success', 'Réponse mise à jour avec succès !');
    }
    
    public function destroy(Reponse $reponse)
    {
        $reponse->delete();
        return redirect()->route('user.activites.responses')
                         ->with('success', 'Réponse supprimée avec succès !');
    }
}