<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    public function voters()
    {
        return $this->belongsToMany(User::class, 'votes')
                   ->withPivot('nbreVote')
                   ->withTimestamps();
    }

    public function vote()
    {
        return $this->hasMany(Vote::class);
    }

    // Méthode pour vérifier si l'utilisateur courant a voté
    public function userHasVoted()
    {
        return auth()->check() ? 
               $this->voters()->where('user_id', auth()->id())->exists() : 
               false;
    }

    public function votesCount()
    {
        return $this->voters()->sum('nbreVote');
    }
}