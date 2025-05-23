<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reponses()
    {
        return $this->hasMany(Reponse::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
    public function tags(){
    return $this->belongsToMany(Tag::class);
}
}
