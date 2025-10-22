@extends('adminlte::page')

@section('title', 'Add Blog')

@section('content_header')
    <h1>Add Blog</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group mb-3">
                <label>Title</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label>Banner Image</label>
                <input type="file" name="banner_image" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label>Tags</label>
                <input type="text" name="tags" class="form-control" placeholder="e.g. marketing, business">
            </div>

            <div class="form-group mb-3">
                <label>Location</label>
                <input type="text" name="location" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label>Description</label>
                <textarea name="description" id="description" rows="5" class="form-control"></textarea>
            </div>

            <button type="submit" class="btn btn-success">Create Blog</button>
            <a href="{{ route('blogs.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@stop
@section('js')
    <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('description', {
            height: 300,
            removeButtons: 'PasteFromWord',
        });
    </script>
@stop
