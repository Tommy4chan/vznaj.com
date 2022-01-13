@extends('layout')

@section('title'){{$subject}}@endsection

@section('main_content')
<h1>{{$subject}}</h1>

@include('layouts.taskGroup')

@endsection

