@extends('adminlte::page')

@section('title', 'Enrollments')

@section('content_header')
    <h1>Enrollments</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Type</th>
                    <th>Reference ID</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($enrollments as $index => $enrollment)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $enrollment->name }}</td>
                        <td>{{ $enrollment->email }}</td>
                        <td>{{ $enrollment->mobile_no }}</td>
                        <td>{{ ucfirst($enrollment->type) }}</td>
                        <td>{{ $enrollment->reference_id }}</td>
                        <td>{{ $enrollment->created_at->format('d M Y, h:i A') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No enrollments yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@stop
