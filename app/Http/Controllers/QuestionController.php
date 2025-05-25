<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tag;

class QuestionController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->query('filter', 'new');
    
        $query = Question::with(['user', 'tags', 'reponses', 'group']) // Ajout du chargement du groupe
            ->withCount('reponses');
            // Suppression de la condition whereNull('group_id')
    
        switch ($filter) {
            case 'top':
                $query->orderByRaw('(SELECT COALESCE(SUM(votes.nbreVote), 0) 
                                   FROM reponses 
                                   JOIN votes ON reponses.id = votes.reponse_id 
                                   WHERE reponses.question_id = questions.id) DESC');
                break;
            case 'unanswered':
                $query->having('reponses_count', '=', 0)
                      ->orderBy('datePost', 'desc');
                break;
            case 'new':
            default:
                $query->orderBy('datePost', 'desc');
                break;
        }
    
        $questions = $query->paginate(10);
        
        return view('home', compact('questions', 'filter'));
    }

    public function show(Question $question)
    {
        // Charge la question avec toutes les relations nécessaires
        $question->load(['user', 'tags', 'reponses.user', 'reponses.votes']);

        return view('users.Questions.show', compact('question'));
    }

    public function showQuestion(Question $question)  // dans le profile de user
    {
        $question->load(['user', 'tags', 'reponses.user', 'reponses.votes']);

        return view('users.profile.showQuestion', compact('question'));
    }

    public function create()
    {
        $groups = Group::all();
        return view('users.Questions.create', compact('groups'));
    }

    public function store(Request $request)
    {
      
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'contentType' => 'required|in:question,help,discussion',
            'group_id' => 'nullable|exists:groups,id',
            'tags' => 'required|json'
        ]);

        // Création de la question
        $question = Question::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'contentType' => $validated['contentType'],
            'user_id' => Auth::id(),
            'group_id' => $validated['group_id']
        ]);

        // Attachement des tags
        $tagIds = json_decode($validated['tags']);
        $question->tags()->attach($tagIds);

        return redirect()->route('questions.index')->with('success', 'Question publiée avec succès!');
        //  return redirect()->route('questions.show', $question->id)
        //     ->with('success', 'Question publiée avec succès!');
    }
    
    public function questionForm()
    {
        $groups = Group::all();
        return view('users.Questions.index', compact('groups'));
    }


    public function searchApi(Request $request)
    {
        $request->validate([
            'q' => 'required|string|min:2|max:50'
        ]);

        $searchTerm = $request->input('q');

        return Question::query()
            ->where('title', 'like', "%{$searchTerm}%")
            ->whereNull('group_id') // Seulement les questions hors groupes
            ->limit(10)
            ->get(['id', 'title'])
            ->map(function ($question) {
                return [
                    'id' => $question->id,
                    'text' => $question->title,
                    'url' => route('questions.show', $question->id)
                ];
            });
    }

        public function search(Request $request)
    {
        $validated = $request->validate([
            'q' => 'nullable|string|max:100',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'filter' => 'nullable|in:new,top,unanswered',
            'group' => 'nullable|exists:groups,id',
            'user' => 'nullable|exists:users,id',
            'answered' => 'nullable|boolean'
        ]);

        $query = Question::with(['user', 'tags', 'group'])
            ->withCount(['reponses as reponses_count'])
            ->when($validated['q'] ?? null, function ($q, $search) {
                $q->where(function($query) use ($search) {
                    $query->where('title', 'like', "%{$search}%")
                        ->orWhere('content', 'like', "%{$search}%");
                });
            })
            ->when($validated['tags'] ?? null, function ($q, $tags) {
                $q->whereHas('tags', function($query) use ($tags) {
                    $query->whereIn('tags.id', $tags);
                });
            })
            ->when($validated['group'] ?? null, function ($q, $groupId) {
                $q->whereHas('group', function($query) use ($groupId) {
                    $query->where('groups.id', $groupId);
                });
            })
            ->when($validated['user'] ?? null, function ($q, $userId) {
                $q->where('user_id', $userId);
            })
            ->when(isset($validated['answered']), function ($q) use ($validated) {
                if ($validated['answered']) {
                    $q->has('reponses');
                } else {
                    $q->doesntHave('reponses');
                }
            });

        // Gestion des tris
        switch ($validated['filter'] ?? 'new') {
            case 'top':
                // Comme vous n'avez pas de votes sur les questions, on trie par réponses
                $query->orderBy('reponses_count', 'desc');
                break;
            case 'unanswered':
                $query->having('reponses_count', '=', 0)
                    ->orderBy('datePost', 'desc');
                break;
            case 'new':
            default:
                $query->latest('datePost');
        }

        $questions = $query->paginate(15)
            ->appends($request->query());

        return view('users.Questions.search-resultats', [
            'questions' => $questions,
            'searchParams' => $validated,
            'searchQuery' => $validated['q'] ?? null,
            'popularTags' => Tag::popular()->take(15)->get()
        ]);
    }
}
