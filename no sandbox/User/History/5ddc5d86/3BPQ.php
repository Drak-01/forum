<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index(Request $request)
{
    $filter = $request->query('filter', 'new');
    
    $query = Question::with(['user', 'tags', 'reponses'])
                ->withCount('reponses');
    
    switch($filter) {
        case 'top':
            $query->orderByRaw('(SELECT COALESCE(SUM(votes.nbreVote), 0) FROM reponses JOIN votes ON reponses.id = votes.reponse_id WHERE reponses.quest_id = questions.id) DESC');
            break;
        case 'new':
        default:
            $query->orderBy('datePost', 'desc');
            break;
    }
    
    $questions = $query->paginate(10);
    
    return view('questions.index', compact('questions', 'filter'));
}
}
