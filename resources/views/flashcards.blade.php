@extends('layouts.app')

@section('content')
    <style>
        #flashcards, #results {
            -webkit-perspective: 800;
            width: 400px;
            height: 200px;
            position: relative;
            margin: 50px auto;
            color: black;
        }
        #flashcards .card {
            width: 100%;
            height: 100%;
            -webkit-transform-style: preserve-3d;
            transition: all 0.7s;
            -webkit-transition: all 0.7s;
            border-radius: 5px;
            border: 1px solid black;
            margin-bottom: 20px;
        }
        #flashcards .card .face {
            width: 100%;
            height: 100%;
            position: absolute;
            -webkit-backface-visibility: hidden;
            z-index: 2;
            font-family: Georgia;
            font-size: 3em;
            text-align: center;
            line-height: 200px;
        }
        #flashcards .card .front {
            position: absolute;
            z-index: 1;
            cursor: pointer;
        }
        #flashcards .card .back {
            transform: rotateX(-180deg);
            -webkit-transform: rotatex(-180deg);
        }
        #flashcards .card.flipped {
            transform: rotateX(-180deg);
            -webkit-transform: rotatex(-180deg);
        }

        #results .right, #results .wrong{
            margin-top: 60px;
            display: inline-block;
            font-size: 72px;
        }

        .right{
            color: green;
        }

        .wrong{
            color: red;
        }

    </style>
    <div id="flashcards"></div>

    <div id="results">
        <div class="col-md-6 text-center">
            <div class="right">0</div>
        </div>
        <div class="col-md-6 text-center">
            <div class="wrong">0</div>
        </div>
    </div>
    @endsection

    @section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="/js/jquery.pietimer.js"></script>
    <script>
        var words = [];
        var wrong = 0, right = 0;
        @foreach($words as $word)
            words.push(new Array('{!! $word->word !!}', '{!! $word->translation !!}'));
        @endforeach
        console.log(words);

        function createCard(){
            var rnd = Math.floor(Math.random() * (words.length));
            var card = $('<div class="card"></div>'),
                front = $('<div class="face front"></div>').text(words[rnd][0]),
                back = $('<div class="face back"></div>').text(words[rnd][1]).append($('<div id="timer"></div>')),
                input = $('<form class="form-horizontal"><div class="form-group"><div class="col-md-9">' +
                        '<input type="text" name="word" id="word" class="form-control"></div>' +
                        '<button id="wordSubmit" class="btn btn-default">Check</button></div></form>');

            $('#flashcards').append(card.append(front).append(back)).append(input);
            $('#timer').pietimer({seconds: 3, color: '#90CAF9', height: 40, width: 40},
                    function(){
                        recreateCard();
                    });
            $('#wordSubmit').click(function(e){
                e.preventDefault();
                if($('#word').val().toLowerCase() === $('.back').text().toLowerCase()){
                    $('.card').css('background', '#81C784').css('border', '1px solid #66BB6A'); // green
                    right += 1;
                }
                else{
                    $('.card').css('background', '#E57373').css('border', '1px solid #EF5350'); // red
                    wrong += 1;
                }
                $('.card').addClass('flipped');
                $('.right').text(right);
                $('.wrong').text(wrong);
                $('#timer').pietimer('start');
            });
        }
        createCard();

        function recreateCard(){
            $('#flashcards').html('');
            createCard();
        }
    </script>
@endsection