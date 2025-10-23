<div class="card mt-4">
    <div class="card-header bg-info text-white d-flex justify-content-between">
        <h5 class="mb-0">Team Members</h5>
        <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#addTeamModal">+ Add Member</button>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Designation</th>
                    <th>Description</th>
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
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->designation }}</td>
                        <td>{{ $item->description }}</td>
                        <td>
                            <form action="{{ url('/api/pages/repeat/' . $item->id) }}" method="POST" onsubmit="return confirm('Delete this team member?')">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center">No team members yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addTeamModal" tabindex="-1">
    <div class="modal-dialog">
        <form class="modal-content" enctype="multipart/form-data" method="POST" action="/api/pages/repeat/store">
            @csrf
            <input type="hidden" name="page_name" value="about">
            <input type="hidden" name="section_key" value="team_members">

            <div class="modal-header">
                <h5 class="modal-title">Add Team Member</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="form-group mb-3">
                    <label>Image</label>
                    <input type="file" name="image" class="form-control">
                </div>
                <div class="form-group mb-3">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label>Designation</label>
                    <input type="text" name="designation" class="form-control" required>
                </div>
                <div class="form-group mb-3">
                    <label>Description</label>
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
