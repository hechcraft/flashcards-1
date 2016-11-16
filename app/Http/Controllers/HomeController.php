<?php

namespace flashcards\Http\Controllers;

use Illuminate\Http\Request;
use flashcards\Word;
use flashcards\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $words = $request->user()->words()->get();
        return view('home')->with('words', $words);
    }
}
