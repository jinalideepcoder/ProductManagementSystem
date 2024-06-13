@extends('layout.master')
@section('header')
    <title>dashboard</title>
@endsection
@section('content')
    @extends('layout.sidebar')

    <h2 class="text-center m-3 ">Welcome {{ auth()->user()->name }}</h2>
@endsection
