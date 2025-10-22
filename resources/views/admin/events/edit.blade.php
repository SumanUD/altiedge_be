@extends('adminlte::page')

@section('title', 'Edit Event')

@section('content_header')
    <h1>Edit Event</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label>Title</label>
                <input type="text" name="title" value="{{ $event->title }}" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label>Sub-heading</label>
                <input type="text" name="sub_heading" value="{{ $event->sub_heading }}" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label>Description</label>
                <textarea name="description" id="description" rows="5" class="form-control">{{ $event->description }}</textarea>
            </div>

            <div class="form-group mb-3">
                <label>Gallery Images</label><br>
                @if($event->gallery_images)
                    @foreach($event->gallery_images as $img)
                        <img src="{{ asset('storage/' . $img) }}" width="80" height="50" class="me-1 mb-1" style="object-fit:cover;">
                    @endforeach
                @endif
                <input type="file" name="gallery_images[]" multiple class="form-control mt-2">
            </div>

            <button type="submit" class="btn btn-success">Update Event</button>
            <a href="{{ route('events.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@stop

@section('js')
<script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('description', { height: 300 });
</script>
@stop
