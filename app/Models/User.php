<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'userPicture',
    ];
    public function getAvatarAttribute($value)
    {
        return $value ?: null; // ou une URL par défaut
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class, 'group_user', 'user_id', 'group_id');
    }

    public function createdGroups()
    {
        return $this->hasMany(Group::class, 'user_id'); 
        // 'user_id' est la clé étrangère dans la table groups qui référence l'auteur/créateur
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function reponses()
    {
        return $this->hasMany(Reponse::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
