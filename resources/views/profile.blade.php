@extends('layout')

@section('title')Профиль@endsection

@section('main_content')

<h1>Профіль {{Auth::user()->name}}</h1>
<h2>Відповіді на запитання</h2>
@include('layouts.taskGroup')


@endsection
