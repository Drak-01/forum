<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

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
    public function show(Group $group)
    {
        $group->load(['user', 'users', 'questions.user', 'questions.tags'])
             ->loadCount(['users', 'questions']);

        return view('groups.show', compact('group'));
    }
}
