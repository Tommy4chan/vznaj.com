@extends('layout')



@section('main_content')
<h1>{{$subject}}</h1>

    @foreach($questions as $el)
        <div class="alert alert-warning">
            <h3>{{ $el->title }}</h3>
            <b>{{ $el->subject_show }}</b>
            <p>{{ $el->text }}</p>
            <a href="/task/{{$el->subject}}/{{$el->id}}">Перейти до завдання</a>
        </div>
    @endforeach

@endsection

@section('title'){{$el->subject_show}}@endsection