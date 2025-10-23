@extends('adminlte::page')
@section('title', isset($faq->id) ? 'Edit FAQ' : 'Add FAQ')

@section('content_header')
<h1>{{ isset($faq->id) ? 'Edit FAQ' : 'Add FAQ' }}</h1>
@stop

@section('content')
<form action="{{ isset($faq->id) ? route('faqs.update', $faq->id) : route('faqs.store') }}" method="POST">
    @csrf
    @if(isset($faq->id))
        @method('PUT')
    @endif

    <div class="form-group">
        <label for="question">Question</label>
        <input type="text" name="question" id="question" class="form-control" value="{{ old('question', $faq->question) }}" required>
    </div>

    <div class="form-group">
        <label for="answer">Answer</label>
        <textarea name="answer" id="answer" class="form-control" rows="5" required>{{ old('answer', $faq->answer) }}</textarea>
    </div>

    <div class="form-check">
        <input type="checkbox" name="is_active" id="is_active" class="form-check-input" value="1" {{ old('is_active', $faq->is_active) ? 'checked' : '' }}>
        <label for="is_active" class="form-check-label">Active</label>
    </div>

    <button type="submit" class="btn btn-success mt-2">{{ isset($faq->id) ? 'Update' : 'Create' }}</button>
    <a href="{{ route('faqs.index') }}" class="btn btn-secondary mt-2">Back</a>
</form>
@stop
