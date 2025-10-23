<div class="card mt-4">
    <div class="card-header bg-info text-white d-flex justify-content-between">
        <h5 class="mb-0">Testimonials</h5>
        <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#addTestimonialModal">+ Add Testimonial</button>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Text</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $item)
                    <tr>
                        <td>
                            @if($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" width="80">
                            @endif
                        </td>
                        <td>{{ $item->description }}</td>
                        <td>
                            <form action="{{ url('/api/pages/repeat/' . $item->id) }}" method="POST" onsubmit="return confirm('Delete this testimonial?')">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="3" class="text-center">No testimonials added yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addTestimonialModal" tabindex="-1">
    <div class="modal-dialog">
        <form class="modal-content" enctype="multipart/form-data" method="POST" action="/api/pages/repeat/store">
            @csrf
            <input type="hidden" name="page_name" value="home">
            <input type="hidden" name="section_key" value="testimonials">

            <div class="modal-header">
                <h5 class="modal-title">Add Testimonial</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="form-group mb-3">
                    <label>Image</label>
                    <input type="file" name="image" class="form-control">
                </div>
                <div class="form-group mb-3">
                    <label>Text</label>
                    <textarea name="description" class="form-control" rows="3" required></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success">Add</button>
            </div>
        </form>
    </div>
</div>
@section('js')
    {{-- Include Bootstrap JS if not already loaded --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Your existing JS --}}
    @stack('js')
@stop
