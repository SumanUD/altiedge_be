@extends('adminlte::page')

@section('title', 'Events')

@section('content_header')
    <h1>Events</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title mb-0">All Events</h3>
        <a href="{{ route('events.create') }}" class="btn btn-primary btn-sm">+ Add Event</a>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Sub-heading</th>
                    <th>Gallery</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($events as $event)
                    <tr>
                        <td>{{ $event->id }}</td>
                        <td>{{ $event->title }}</td>
                        <td>{{ $event->sub_heading }}</td>
                        <td>
                            @if($event->gallery_images)
                                @foreach($event->gallery_images as $img)
                                    <img src="{{ asset('storage/' . $img) }}" width="60" height="40" class="me-1 mb-1" style="object-fit:cover;">
                                @endforeach
                            @else
                                <span class="text-muted">No images</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('events.edit', $event->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Delete this event?')" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No events found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@stop
