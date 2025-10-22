@extends('adminlte::page')

@section('title', 'Programs')

@section('content_header')
    <h1>Programs</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title mb-0">All Programs</h3>
        <a href="{{ route('programs.create') }}" class="btn btn-primary btn-sm">+ Add Program</a>
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
                    <th>Location</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($programs as $program)
                    <tr>
                        <td>{{ $program->id }}</td>
                        <td>{{ $program->title }}</td>
                        <td>{{ $program->sub_heading }}</td>
                        <td>{{ $program->location }}</td>
                        <td>{{ $program->program_date }}</td>
                        <td>
                            <a href="{{ route('programs.edit', $program->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('programs.destroy', $program->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Delete this program?')" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No programs found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@stop
