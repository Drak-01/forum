<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reponse extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'content',
        'description',
        'datePost',
        'contentType',
        'question_id',
        'user_id'
    ];

    

    // Relations
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    public function userHasVoted()
    {
        if (!auth()->check()) return false;
        
        return $this->votes()
                ->where('user_id', auth()->id())
                ->exists();
    }

    // Méthode pour compter les votes
    public function votesCount()
    {
        return $this->votes()->sum('nbreVote');
    }

    // Formatage de date
    public function getDatePostFormattedAttribute()
    {
        return $this->datePost->format('d/m/Y');
    }

    protected $casts = [
        'datePost' => 'datetime',
    ];

    public function datePost(){
        return date('d/m/Y', strtotime($this->created_at));
    }

    public function voters()
    {
        return $this->belongsToMany(User::class, 'votes')
                ->withPivot('nbreVote')
                ->withTimestamps();
    }
    // app/Models/Question.php


}