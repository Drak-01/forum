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
        $user = auth()->user();
        
        $groups = Group::whereHas('users', function($query) use ($user) {
                    $query->where('user_id', $user->id);
                })
                ->orWhere('user_id', $user->id) // groupes créés par l'utilisateur
                ->with(['user', 'users'])
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
            'description' => 'nullable|string|min:10', // Changé de longText à string
            'groupPicture' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);
    
        // Handle file upload if image is provided
        $imagePath = null;
        if ($request->hasFile('groupPicture')) {
            $imagePath = $request->file('groupPicture')->store('group_pictures', 'public'); // Nom de dossier plus cohérent
        }
    
        // Create the group and associate with authenticated user
        Group::create([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'groupPicture' => $imagePath,
            'createdAt' => now(), 
            'user_id' => auth()->id(), 
        ]);
    
        return redirect()->route('groups.show', ['group' => Group::latest()->first()->id])
                        ->with('success', 'Groupe créé avec succès !');    
    }

    public function show($id)
    {
        //dd("icu");
        $group = Group::with('messages.user')->findOrFail($id);
        $messages = Message::where('group_id', $group->id)->with('user')->latest()->get();

        return view('users.groups.questions', compact('group', 'messages'));
    }
   
    public function showMessages($groupId)
    {
        $group = Group::with(['messages.user'])->findOrFail($groupId);
        return view('users.groups.message', [
            'group' => $group,
            'messages' => $group->messages()->latest()->paginate(15)
        ]);
    }

    public function gmembres($id)
    {
        $group = Group::with(['users' => function($query) {
                    $query->select('users.id', 'username', 'userPicture');
                }])
                ->findOrFail($id);
    
        return view('users.groups.membres', compact('group'));
    }
}
