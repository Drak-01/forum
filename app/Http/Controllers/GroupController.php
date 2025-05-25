<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\Models\Question;
use App\Models\Reponse;


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
    
    public function all()
    {
        $groups = Group::paginate(10);;
        return view('users.groups.all-group', compact('groups'));
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

    public function show($groupId)
    {
        $group = Group::findOrFail($groupId);
        
        $questions = Question::where('group_id', $groupId)
                        ->selectRaw('questions.*, (SELECT COUNT(*) FROM reponses WHERE questions.id = reponses.question_id) as reponses_count')
                        ->with(['user', 'tags', 'reponses.user'])
                        ->get();

        return view('users.groups.questions', compact('group', 'questions'));
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

    public function join($groupId)
    {
        // Vérifie si l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect()->route('login.index')->with('error', 'You must be logged in to join a group.');
        }

        $user = Auth::user();

        $group = Group::findOrFail($groupId);

        $isMember = $group->users()->where('user_id', $user->id)->exists();

        if (!$isMember) {
            $group->users()->attach($user->id);
        }

        return redirect()->back()->with('success', 'You have joined the group successfully.');
    }


    public function showQuestion($groupId, $questionId)
    {
        $group = Group::findOrFail($groupId);
        $question = Question::with(['user', 'tags', 'reponses.user'])
                          ->withCount('reponses')
                          ->findOrFail($questionId);

        return view('groups.question-show', compact('group', 'question'));
    }

    public function storeReponse(Request $request, $groupId, $questionId)
    {
        $request->validate([
            'content' => 'required|string'
        ]);

        Reponse::create([
            'content' => $request->content,
            'question_id' => $questionId,
            'user_id' => auth()->id()
        ]);

        return redirect()->back();
    }

    public function leave(Group $group)
    {
        // Vérifier que l'utilisateur est membre du groupe
        if (!Auth::user()->groups->contains($group->id)) {
            return redirect()->back()
                ->with('error', "Vous n'êtes pas membre de ce groupe");
        }

        // Vérifier si l'utilisateur est le créateur du groupe
        if ($group->user_id === Auth::id()) {
            return redirect()->back()
                ->with('error', "Le créateur ne peut pas quitter le groupe");
        }

        // Retirer l'utilisateur du groupe
        Auth::user()->groups()->detach($group->id);

        return redirect()->back()->with('success', 'You have joined the group successfully.');

    }


    public function createQuestion($groupId)
    {
        $group = Group::findOrFail($groupId); 
        
        return view('users.groups.questPoste', [
            'group' => $group 
        ]);
    }

    public function storeQuestion(Request $request, $groupId = null)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'contentType' => 'required|in:question,help,discussion',
            'tags' => 'required|json'
        ]);
    
        $questionData = [
            'title' => $validated['title'],
            'content' => $validated['content'],
            'contentType' => $validated['contentType'],
            'user_id' => Auth::id()
        ];
    
        if ($groupId) {
            $questionData['group_id'] = $groupId;
        }
    
        $question = Question::create($questionData);
        
        // ... gestion des tags ...
    
        $redirectRoute = $groupId ? 
            route('user.group.show', $groupId) : 
            route('questions.index');
        
        return redirect($redirectRoute)->with('success', 'Question publiée!');
    }

    

}
