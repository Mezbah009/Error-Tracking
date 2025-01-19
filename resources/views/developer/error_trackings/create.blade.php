@extends('developer.layouts.app')

@section('content')
    <div class="container">
        <h1>Add Error Tracking</h1>
        <form action="{{ route('developer_error_trackings.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="developer_id">Developer</label>
                <select name="developer_id" class="form-control" required>
                    <option value="">Select Developer</option>
                    @foreach ($developers as $developer)
                        <option value="{{ $developer->id }}">{{ $developer->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="project_id">Project</label>
                <select name="project_id" class="form-control" required>
                    <option value="">Select Project</option>
                    @foreach ($projects as $project)
                        <option value="{{ $project->id }}">{{ $project->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" name="date" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="error_type">Error Type</label>
                <input type="text" name="error_type" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="solution_description">Solution Description</label>
                <textarea name="solution_description" class="form-control" rows="4" required></textarea>
            </div>

            <div class="form-group">
                <label for="solution_provided_by">Solution Provided By</label>
                <input type="text" name="solution_provided_by" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" class="form-control" required>
                    <option value="Pending">Pending</option>
                    <option value="Resolved">Resolved</option>
                    <option value="In Progress">In Progress</option>
                </select>
            </div>

            <div class="form-group">
                <label for="comments">Comments</label>
                <textarea name="comments" class="form-control" rows="4"></textarea>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </form>
    </div>
@endsection
