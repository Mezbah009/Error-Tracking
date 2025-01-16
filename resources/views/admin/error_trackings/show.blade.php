@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Error Tracking Details</h1>

    <div class="card">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $errorTracking->id }}</p>
            <p><strong>Developer Name:</strong> {{ $errorTracking->developer->name ?? 'N/A' }}</p>
            <p><strong>Project Name:</strong> {{ $errorTracking->project->title ?? 'N/A' }}</p>
            <p><strong>Date:</strong> {{ $errorTracking->date }}</p>
            <p><strong>Error Type:</strong> {{ $errorTracking->error_type }}</p>
            <p><strong>Solution Description:</strong> {{ $errorTracking->solution_description }}</p>
            <p><strong>Solution Provided By:</strong> {{ $errorTracking->solution_provided_by }}</p>
            <p><strong>Status:</strong> {{ $errorTracking->status }}</p>
            <p><strong>Comments:</strong> {{ $errorTracking->comments ?? 'N/A' }}</p>
        </div>
    </div>

    <a href="{{ route('error_trackings.index') }}" class="btn btn-secondary mt-3">Back to List</a>
</div>
@endsection
