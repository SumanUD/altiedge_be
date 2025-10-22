@extends('adminlte::page')

@section('title', 'Blogs')

@section('content_header')
    <h1>Blogs</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0">All Blogs</h3>
            <a href="{{ route('blogs.create') }}" class="btn btn-primary btn-sm">+ Add New Blog</a>
        </div>

        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Banner</th>
                        <th>Title</th>
                        <th>Tags</th>
                        <th>Location</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($blogs as $blog)
                        <tr>
                            <td>{{ $blog->id }}</td>
                            <td>
                                @if($blog->banner_image)
                                    <img src="{{ asset('storage/' . $blog->banner_image) }}" width="80" height="50" style="object-fit:cover;">
                                @else
                                    <span class="text-muted">No Image</span>
                                @endif
                            </td>
                            <td>{{ $blog->title }}</td>
                            <td>{{ $blog->tags }}</td>
                            <td>{{ $blog->location }}</td>
                            <td>
                                <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Delete this blog?')" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No blogs found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@stop
