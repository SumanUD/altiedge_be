@extends('adminlte::page')

@section('title', 'Add Program')

@section('content_header')
    <h1>Add Program</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('programs.store') }}" method="POST">
            @csrf

            <div class="form-group mb-3">
                <label>Title</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label>Sub-heading</label>
                <input type="text" name="sub_heading" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label>Location</label>
                <input type="text" name="location" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label>Date</label>
                <input type="date" name="program_date" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label>Description</label>
                <textarea name="description" id="description" rows="5" class="form-control"></textarea>
            </div>

            <button type="submit" class="btn btn-success">Create Program</button>
            <a href="{{ route('programs.index') }}" class="btn btn-secondary">Cancel</a>
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
