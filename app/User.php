<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The field to be used for route model binding.
     *
     * @return string
     */
    public function getRouteKeyName(){
        return 'username';
    }

    /**
     * A user may have multiple snippets.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function snippets()
    {
        return $this->hasMany(Snippet::class);
    }

    /**
     * A user may have multiple votes.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function votes()
    {
        return $this->belongsToMany(Snippet::class, 'snippets_votes')->withTimestamps();
    }

    /**
     * Determine if a user voted for a given snippet.
     *
     * @param  Snippet $snippet
     * @return bool
     */
    public function votedFor(Snippet $snippet)
    {
        return $snippet->votes->contains('user_id', $this->id);
    }
}
