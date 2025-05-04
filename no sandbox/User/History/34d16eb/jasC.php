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

}
