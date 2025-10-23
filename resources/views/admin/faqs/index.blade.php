@extends('adminlte::page')
@section('title', 'FAQs')

@section('content_header')
<h1>FAQs</h1>
@stop

@section('content')
<a href="{{ route('faqs.create') }}" class="btn btn-primary mb-2">Add FAQ</a>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Question</th>
            <th>Answer</th>
            <th>Active</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($faqs as $faq)
        <tr>
            <td>{{ $faq->id }}</td>
            <td>{{ $faq->question }}</td>
            <td>{{ $faq->answer }}</td>
            <td>{{ $faq->is_active ? 'Yes' : 'No' }}</td>
            <td>
                <a href="{{ route('faqs.edit', $faq->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('faqs.destroy', $faq->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete FAQ?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@stop
