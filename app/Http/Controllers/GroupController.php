<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

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

    //Création de groupe
    public function creerpage(){
        return view('users.groups.create');
    }

    public function mesGroupes()
    {
        $user = auth()->user();
        
        return view('users.groups.index', [
            'groups' => $user->groups()
                ->with(['user', 'users'])
                ->withCount(['users', 'questions'])
                ->orderBy('created_at', 'desc')
                ->paginate(10)
        ]);
    }

    public function store(Request $request)
    {
    }
}
