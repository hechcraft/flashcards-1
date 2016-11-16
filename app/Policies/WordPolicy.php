<?php

namespace flashcards\Policies;

use flashcards\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use flashcards\Word;

class WordPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function destroy(User $user, Word $word)
    {
        return $user->id === $word->user_id;
    }
}
