<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Question;
use Illuminate\Http\Request;

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
    { dd($request->all());
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'group_id' => 'required|exists:groups,id',
        ]);

        $question = new Question();
        $question->title = $request->input('title');
        $question->content = $request->input('content');
        $question->user_id = auth()->id();
        $question->group_id = $request->input('group_id');
        $question->save();

        return redirect()->route('questions.index')->with('success', 'Question created successfully.');
    } 
    public function questionForm(){
        return view('users.Questions.index');
    }

}
