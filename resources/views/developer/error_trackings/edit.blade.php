@extends('developer.layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit Error Tracking</h1>

    <form action="{{ route('developer_error_trackings.update', $errorTracking->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="developer_id" class="form-label">Developer Name</label>
            <select name="developer_id" id="developer_id" class="form-control" required>
                <option value="">Select Developer</option>
                @foreach($developers as $developer)
                    <option value="{{ $developer->id }}" {{ $errorTracking->developer_id == $developer->id ? 'selected' : '' }}>
                        {{ $developer->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="project_id" class="form-label">Project Name</label>
            <select name="project_id" id="project_id" class="form-control" required>
                <option value="">Select Project</option>
                @foreach($projects as $project)
                    <option value="{{ $project->id }}" {{ $errorTracking->project_id == $project->id ? 'selected' : '' }}>
                        {{ $project->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" name="date" id="date" class="form-control" value="{{ $errorTracking->date }}" required>
        </div>

        <div class="mb-3">
            <label for="error_type" class="form-label">Error Type</label>
            <input type="text" name="error_type" id="error_type" class="form-control" value="{{ $errorTracking->error_type }}" required>
        </div>

        <div class="mb-3">
            <label for="solution_description" class="form-label">Solution Description</label>
            <textarea name="solution_description" id="solution_description" class="form-control" rows="4" required>{{ $errorTracking->solution_description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="solution_provided_by" class="form-label">Solution Provided By</label>
            <input type="text" name="solution_provided_by" id="solution_provided_by" class="form-control" value="{{ $errorTracking->solution_provided_by }}" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="Pending" {{ $errorTracking->status == 'Pending' ? 'selected' : '' }}>In Progress</option>
                <option value="Resolved" {{ $errorTracking->status == 'Resolved' ? 'selected' : '' }}>Resolved</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="comments" class="form-label">Comments</label>
            <textarea name="comments" id="comments" class="form-control" rows="4">{{ $errorTracking->comments }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('error_trackings.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
