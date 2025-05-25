<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserActiviteController extends Controller
{
    //
    public function index()
    { // Le groupe qui sera afficher par défaut

        $user = auth()->user();

        $groups = $user->createdGroups()
            ->withCount('users')
            ->orderBy('id', 'desc')
            ->paginate(10);

        $memberGroups = $user->groups()
            ->withCount('users')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('users.groups.index', compact('groups', 'memberGroups'));

        // return view('users.profile.activite', compact('groups', 'memberGroups'));
    }

    public function useQuestions()
    {
        //Cette fonction pemet de chercher la liste des questions d'un utilisateurs precise
        $user = Auth::user();
        $questions = $user->questions;
        $total = $questions->count();

        return view('users.Questions.UserQuestion',  compact('questions', 'total'));
    }

    public function useResponses()
    {
        $user = Auth::user();
        $reponses = $user->reponses;
        $total = $reponses->count();
        return view('users.reponse.userReponse', compact('reponses', 'total'));
    }

    
}