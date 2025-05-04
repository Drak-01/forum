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
    // public function index(Request $request)
    // {
    //     $filter = $request->query('filter', 'new');

    //     $query = Question::with(['user', 'tags', 'reponses'])
    //         ->withCount('reponses');

    //     switch ($filter) {
    //         case 'top':
    //             $query->orderByRaw('(SELECT COALESCE(SUM(votes.nbreVote), 0) FROM reponses JOIN votes ON reponses.id = votes.reponse_id WHERE reponses.question_id = questions.id) DESC');
    //             break;
    //         case 'new':
    //         default:
    //             $query->orderBy('datePost', 'desc');
    //             break;
    //     }

    //     $questions = $query->paginate(10);
    //     $groups = Group::withCount('users') // Ajoutez le nombre de membres
    //         ->orderBy('createdAt', 'desc')
    //         ->limit(5) // Limitez à 5 groupes
    //         ->get();

    //     return view('home', compact('questions', 'filter', 'groups'));
    // }


    public function show(Question $question)
    {
        // Charge la question avec toutes les relations nécessaires
        $question->load(['user', 'tags', 'reponses.user', 'reponses.votes']);

        return view('questions.show', compact('question'));
    }
}
