<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name', 'color'];

    public function questions(){
        return $this->belongsToMany(Question::class);
    }

    public function scopePopular($query)
    {
        return $query->withCount('questions')
                   ->orderByDesc('questions_count');
    }

    public static function search($query)
    {
        return self::where('name', 'like', "%{$query}%")
                  ->popular()
                  ->limit(10)
                  ->get();
    }
}
