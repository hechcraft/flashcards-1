@extends('layouts.app')

@section('content')
    <script>
        var words = [];
        @foreach($words as $word)
            words.push(new Array('{!! $word->word !!}', '{!! $word->translation !!}'));
        @endforeach
        console.log(words);
    </script>
@endsection