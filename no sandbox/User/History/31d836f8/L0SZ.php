<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reponse extends Model
{
    public $timestamps = false;

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
