@extends('adminlte::page')

@section('title', ucfirst($page_name) . ' Page Settings')

@section('content_header')
    <h1>{{ ucfirst($page_name) }} Page Settings</h1>
@stop

@section('content')
<div class="container">
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Text Sections</h5>
        </div>
        <div class="card-body">
            <form id="sectionsForm">
                @csrf
                @php
                    $textSections = [
                        'home' => ['below_banner_text', 'about_us_text', 'art_text'],
                        'about' => ['below_banner_text'],
                        'art' => ['below_banner_text', 'how_to_take_test_text'],
                    ];
                @endphp

                @foreach ($textSections[$page_name] as $key)
                    <div class="form-group mb-3">
                        <label for="{{ $key }}" class="fw-bold text-capitalize">{{ str_replace('_', ' ', $key) }}</label>
                        <textarea name="{{ $key }}" id="{{ $key }}" class="form-control" rows="3">{{ $sections[$key]->content ?? '' }}</textarea>
                    </div>
                @endforeach

                <button type="button" id="saveSections" class="btn btn-success">Save Changes</button>
            </form>
        </div>
    </div>

    {{-- Repeatable Sections --}}
    @if ($page_name === 'home')
        @include('admin.pages.partials.testimonials', ['items' => $repeats['testimonials'] ?? collect()])
    @endif

    @if ($page_name === 'about')
        @include('admin.pages.partials.team', ['items' => $repeats['team_members'] ?? collect()])
    @endif
</div>
@stop

@section('js')
<script>
    document.getElementById('saveSections').addEventListener('click', async () => {
        const form = document.getElementById('sectionsForm');
        const formData = new FormData(form);
        const pageName = "{{ $page_name }}";

        for (let [key, value] of formData.entries()) {
            await fetch('/api/pages/update', {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                body: new URLSearchParams({
                    page_name: pageName,
                    section_key: key,
                    content: value
                })
            });
        }

        alert('Sections updated successfully!');
        location.reload();
    });
</script>
@stop


@section('js')
    {{-- Include Bootstrap JS if not already loaded --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Your existing JS --}}
    @stack('js')
@stop

