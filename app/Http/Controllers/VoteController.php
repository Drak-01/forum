<?php

namespace App\Http\Controllers;

use App\Models\Reponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    public function toggleVote(Reponse $reponse)
    {
        $user = auth()->user();
        $hasVoted = $reponse->voters()->where('user_id', $user->id)->exists();

        if ($hasVoted) {
            $reponse->voters()->detach($user->id);
            $action = 'removed';
        } else {
            $reponse->voters()->attach($user->id, ['nbreVote' => 1]);
            $action = 'added';
        }

        return response()->json([
            'success' => true,
            'action' => $action,
            'votes_count' => $reponse->fresh()->votesCount(),
            'has_voted' => !$hasVoted
        ]);
    }
}