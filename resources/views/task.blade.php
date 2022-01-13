@extends('layout')

@section('main_content')
<h1>Сторінка завдання</h1>
    <div class="alert alert-warning">
    @foreach($questions as $el)
        <h3>{{ $el->title }}</h3>
        <b>{{ $el->subject_show }}</b>
        <p>{{ $el->text }}</p>
        <p>{{ ($el->created_at)->diffForHumans()}} </p>
    @endforeach
    <h2>Коментарі до завдання</h1>
    @foreach($comments as $com)
        <div class="alert alert-primary">
            <h5>{{ $com->name }}</h5>
            <p>{{ $com->text }}</p>
    </div>
    @endforeach
    @if(Auth::check())
    <form method="post" action="{{route('comment')}}">
        @csrf
        <textarea name="message" id="message" class="form-control" placeholder="Введите сообщение"></textarea><br>
        <input type="hidden" name="userId" id="userId" value="{{Auth::id()}}">
        <input type="hidden" name="postId" id="postId" value="{{$el->id}}">
        <input type="hidden" name="subject" id="subject" value="{{$el->subject}}">
        <input type="hidden" name="name" id="name" value="{{Auth::user()->name}}">
        <input type="hidden" name="type" id="type" value="0">
        <button type="submit" class="btn btn-success">Отправить</button>
    </form>
    @else
        Щоб добавляти коментарі <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a> на сайт
    @endif
    </div>

    @foreach($answears as $ans)
        <div class="alert alert-success">
            <h5>{{ $ans->name }}</h5>
            <p>{{ $ans->text }}</p>
    </div>
    @endforeach

    @if(Auth::check())
        <form method="post" action="{{route('answear')}}">
            @csrf
            <textarea name="message" id="message" class="form-control" placeholder="Введите відповідь"></textarea><br>
            <input type="hidden" name="userId" id="userId" value="{{Auth::id()}}">
            <input type="hidden" name="postId" id="postId" value="{{$el->id}}">
            <input type="hidden" name="subject" id="subject" value="{{$el->subject}}">
            <input type="hidden" name="name" id="name" value="{{Auth::user()->name}}">
            <button type="submit" class="btn btn-success">Отправить</button>
        </form>
    @else
        Ви не вошли на сайт
            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
        @if (Route::has('register'))
            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
        @endif
    @endif

@endsection

@section('title'){{$el->title}}@endsection


