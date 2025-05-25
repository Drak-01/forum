<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Question;
use App\Models\User;
use App\Models\Group;
use App\Models\Reponse;
use App\Models\Tag;

class UserController extends Controller
{
    //
    public function index(){
        return view('users.profile.index');
    }

    public function update(Request $request){
        $user = Auth::user();

        $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'userPicture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'nullable|min:8|confirmed',
        ]);

        // Mise à jour des informations de base
        $user->firstName = $request->firstName;
        $user->lastName = $request->lastName;

        // Gestion de l'upload de l'image
        if ($request->hasFile('userPicture')) {
            if ($user->userPicture) {
                Storage::delete('public/' . $user->userPicture);
            }
            
            $path = $request->file('userPicture')->store('profile_pictures', 'public');
            $user->userPicture = $path;
        }

        // Mise à jour du mot de passe si fourni
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('questions.index')
               ->with('success', 'Profil mis à jour avec succès');
    }

    public function ranking()
    {
        // Classement des utilisateurs
        $topUsersByQuestions = User::withCount('questions')
                                  ->orderByDesc('questions_count')
                                  ->limit(10)
                                  ->get();

        $topUsersByAnswers = User::withCount('reponses')
                                ->orderByDesc('reponses_count')
                                ->limit(10)
                                ->get();

        // Classement des questions
        $topQuestions = Question::withCount('reponses')
                               ->with('user')
                               ->orderByDesc('reponses_count')
                               ->limit(10)
                               ->get();

        // Classement des groupes
        $topGroupsByActivity = Group::withCount('questions')
                                   ->orderByDesc('questions_count')
                                   ->limit(10)
                                   ->get();

        $topGroupsByMembers = Group::withCount('users')
                                  ->orderByDesc('users_count')
                                  ->limit(10)
                                  ->get();

        // Classement des réponses
        $topAnswers = Reponse::select('reponses.*')
                    ->join('votes', 'votes.reponse_id', '=', 'reponses.id')
                    ->orderByDesc('votes.nbreVote')
                    ->with(['user', 'question'])
                    ->limit(10)
                    ->get();

        // Classement des tags (si vous avez cette table)
        $popularTags = Tag::withCount('questions')
                         ->orderByDesc('questions_count')
                         ->limit(10)
                         ->get();

        return view('users.profile.ranking', [
            'topUsersByQuestions' => $topUsersByQuestions,
            'topUsersByAnswers' => $topUsersByAnswers,
            'topQuestions' => $topQuestions,
            'topGroupsByActivity' => $topGroupsByActivity,
            'topGroupsByMembers' => $topGroupsByMembers,
            'topAnswers' => $topAnswers,
            'popularTags' => $popularTags
        ]);
    }
 
}
