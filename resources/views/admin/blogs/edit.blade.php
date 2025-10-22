@extends('adminlte::page')

@section('title', 'Edit Blog')

@section('content_header')
    <h1>Edit Blog</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label>Title</label>
                <input type="text" name="title" value="{{ $blog->title }}" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label>Banner Image</label><br>
                @if($blog->banner_image)
                    <img src="{{ asset('storage/' . $blog->banner_image) }}" width="120" class="mb-2 rounded">
                @endif
                <input type="file" name="banner_image" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label>Tags</label>
                <input type="text" name="tags" value="{{ $blog->tags }}" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label>Location</label>
                <input type="text" name="location" value="{{ $blog->location }}" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label>Description</label>
                <textarea name="description" rows="5" class="form-control">{{ $blog->description }}</textarea>
            </div>

            <button type="submit" class="btn btn-success">Update Blog</button>
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
