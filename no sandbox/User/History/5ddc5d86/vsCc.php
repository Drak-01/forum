<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->query('filter', 'new');

        $query = Question::with(['user', 'tags', 'reponses'])
            ->withCount('reponses');

        switch ($filter) {
            case 'top':
                $query->orderByRaw('(SELECT COALESCE(SUM(votes.nbreVote), 0) FROM reponses JOIN votes ON reponses.id = votes.reponse_id WHERE reponses.question_id = questions.id) DESC');
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
}
