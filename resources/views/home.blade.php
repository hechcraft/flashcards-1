@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                <form action="/word/add" method="post">
                    <div class="form-group col-md-6">
                        <label>Translate from:</label>
                    <select class="form-control" name="from">
                        <option value="en">English</option>
                        <option value="ru">Russian</option>
                        <option value="pl">Polish</option>
                        <option value="de">German</option>
                    </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Translate to:</label>
                        <select class="form-control" name="to">
                        <option value="ru">Russian</option>
                        <option value="pl">Polish</option>
                        <option value="en">English</option>
                        <option value="de">German</option>
                    </select>
                    </div>
                    <div class="form-group col-md-10 col-md-offset-0">
                        <input type="text" class="form-control" name="word">
                    </div>
                    <button type="submit" class="btn btn-primary">Translate!</button>
                    {{ csrf_field() }}
                </form>
                </div>
            </div>
            @if(count($words) > 0)
            <table class="table table-hover text-center">
                <th class="text-center">Word</th>
                <th class="text-center">Translation</th>
                <th></th>
                @foreach($words as $word)
                    <tr>
                        <td>{{ $word->word }}</td>
                        <td>{{ $word->translation }}</td>
                        <td>
                            <form action="{{ url('/word/delete/'.$word->id) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}

                                <button type="submit" id="delete-word-{{ $word->id }}" class="btn btn-xs btn-danger">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
                @else
            <p>No translations yet.</p>
                @endif
        </div>
    </div>
</div>
@endsection
