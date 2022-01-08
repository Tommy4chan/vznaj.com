@extends('layout')

@section('main_content')
<h1>Сторінка завдання</h1>

    @foreach($questions as $el)
        <div class="alert alert-warning">
            <h3>{{ $el->title }}</h3>
            <b>{{ $el->subject_show }}</b>
            <p>{{ $el->text }}</p>
        </div>
    @endforeach

@endsection

@section('title'){{$el->title}}@endsection


