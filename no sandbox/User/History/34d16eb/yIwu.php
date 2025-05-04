<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
{
    // Liste complète des groupes
    public function index()
    {
        $groups = Group::with(['user', 'users'])
                    ->withCount(['users', 'questions'])
                    ->orderBy('createdAt', 'desc')
                    ->paginate(12);

        return view('groups.index', compact('groups'));
    }

    // Affichage d'un groupe spécifique
    // public function show(Group $group)
    // {
    //     $group->load(['user', 'users', 'questions.user', 'questions.tags'])
    //          ->loadCount(['users', 'questions']);

    //     return view('groups.show', compact('group'));
    // }
    public function show(Group $group)
{
    $group->load([
        'user', 
        'users', 
        'questions.user', 
        'questions.tags',
        'questions.reponses' // Charger les réponses pour le comptage
    ])->loadCount([
        'users',
        'questions',
        'questions as reponses_count' => function($query) {
            $query->select(DB::raw('sum(reponses_count)'))
                  ->from('questions')
                  ->whereColumn('questions.question_id', 'groups.id');
        }
    ]);

    return view('groups.show', compact('group'));
}
}
