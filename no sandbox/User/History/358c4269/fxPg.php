<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation avec les membres du groupe
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    // Relation avec les questions
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
    public function createdAt()
    {
        return $this->created_at;
    }
}
