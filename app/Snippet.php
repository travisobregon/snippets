<?php

namespace App;

class Snippet extends Model
{
    /**
     * A snippet may have multiple forks.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function forks()
    {
        return $this->hasMany(Snippet::class, 'forked_id'); 
    }

    /**
     * A snippet may be forked from another snippet.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function originalSnippet()
    {
        return $this->belongsTo(Snippet::class, 'forked_id');
    }

    /**
     * A snippet is owned by a user.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);   
    }

    /**
     * Determine if the current snippet is a fork.
     * 
     * @return bool
     */
    public function isAFork()
    {
        return !! $this->forked_id;     
    }

    /**
     * A snippet may have multiple votes.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function votes()
    {
        return $this->hasMany(SnippetVote::class); 
    }
}