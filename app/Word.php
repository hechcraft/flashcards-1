<?php

namespace flashcards;

use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    //
    protected $guarded = [];
    public function user()
    {
        $this->belongsTo(User::class);
    }
}
