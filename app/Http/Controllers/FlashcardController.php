<?php

namespace flashcards\Http\Controllers;

use flashcards\User;
use Illuminate\Http\Request;
use Auth;
use Stichoza\GoogleTranslate\TranslateClient;
use Redirect;
use flashcards\Word;

class FlashcardController extends Controller
{
    //
    public function add(Request $request)
    {
        $tr = new TranslateClient();
        $tr->setSource($request->from);
        $tr->setTarget($request->to);

        $translation = $tr->translate($request->word);

        $request->user()->words()->create([
            'user_id' => Auth::user()->id,
            'word' => $request->word,
            'translation' => $translation
        ]);

        return Redirect::back();
    }

    public function delete(Request $request, Word $word)
    {
        $this->authorize('destroy', $word);
        $word->delete();
        return redirect('/home');
    }
}
