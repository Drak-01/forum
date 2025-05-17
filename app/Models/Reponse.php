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
    public function datePost(){
        return date('d/m/Y', strtotime($this->created_at));
    }

    protected $casts = [
        'datePost' => 'datetime',
    ];
}
