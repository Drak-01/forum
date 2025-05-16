<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
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

    $groups = $user->createdGroups()
        ->withCount('users')
        ->orderBy('id', 'desc')
        ->paginate(10);

    $memberGroups = $user->groups()
        ->withCount('users')
        ->orderBy('id', 'desc')
        ->paginate(10);

    return view('users.groups.index', compact('groups', 'memberGroups'));
}





   public function store(Request $request)
{
    // Validate the incoming request
    $validated = $request->validate([
        'name' => 'required|unique:groups,name|max:255',
        'description' => 'nullable|string',
        'groupPicture' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
    ]);

    // Handle file upload if image is provided
    $imagePath = null;
    if ($request->hasFile('groupPicture')) {
        $imagePath = $request->file('groupPicture')->store('groupPicture', 'public');
    }

    // Create the group and associate with authenticated user
    Group::create([
        'name' => $validated['name'],
        'description' => $validated['description'] ?? null,
        'groupPicture' => $imagePath,
        'user_id' => Auth::id(), // or $request->user()->id
    ]);

    return redirect()->route('users.groups')->with('success', 'Groupe créé avec succès !');
}
    public function show($id)
{
    $group = Group::with('messages.user')->findOrFail($id);
     $messages = Message::where('group_id', $group->id)->with('user')->latest()->get();

    return view('users.groups.group-show', compact('group', 'messages'));
}



    
}
