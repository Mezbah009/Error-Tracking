@extends('developer.layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4" style="padding-right: 10px;">
        <h1 class="mb-4">Error Tracking</h1>

        <!-- Add New Error Button aligned to the right -->
        <a href="{{ route('developer_error_trackings.create') }}" class="btn btn-primary ml-auto">Add New Error</a>
    </div>

    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Developer Name</th>
                    <th>Project Name</th>
                    <th>Date</th>
                    <th>Error Type</th>
                    <th>Solution Description</th>
                    <th>Solution Provided By</th>
                    <th>Status</th>
                    <th>Comments</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($errorTrackings as $errorTracking)
                    <tr>
                        <td>{{ $errorTracking->id }}</td>
                        <td>{{ $errorTracking->developer->name ?? 'N/A' }}</td>
                        <td>{{ $errorTracking->project->title ?? 'N/A' }}</td>
                        <td>{{ $errorTracking->date }}</td>
                        <td>{{ $errorTracking->error_type }}</td>
                        <td>{{ $errorTracking->solution_description }}</td>
                        <td>{{ $errorTracking->solution_provided_by }}</td>
                        <td>{{ $errorTracking->status }}</td>
                        <td>{{ $errorTracking->comments }}</td>
                        <td>
                            <a href="{{ route('developer_error_trackings.show', $errorTracking->id) }}"
                                class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('developer_error_trackings.edit', $errorTracking->id) }}"
                                class="btn btn-warning btn-sm">Edit</a>

                            <form action="{{ route('developer_error_trackings.destroy', $errorTracking->id) }}"
                                method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to delete this error tracking record?')">Delete</button>
                            </form>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center">No error tracking records found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination Links -->
    <div class="d-flex justify-content-center">
        {{ $errorTrackings->links() }}
    </div>
@endsection
