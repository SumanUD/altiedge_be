@extends('adminlte::page')

@section('title', 'Admin Dashboard')

@section('content_header')
    <h1>Welcome, {{ Auth::user()->name }}</h1>
@stop

@section('content')
    <p>Use the sidebar to manage Blogs, Events, and Programs.</p>
@stop
