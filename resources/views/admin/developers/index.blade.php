@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <h1>Developers</h1>
        <a href="{{ route('developers.create') }}" class="btn btn-primary mb-3">Add Developer</a>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($developers as $developer)
                    <tr>
                        <td>{{ $developer->id }}</td>
                        <td>{{ $developer->name ?? 'N/A' }}</td>
                        <td>{{ $developer->mobile ?? 'N/A' }}</td>
                        <td>{{ $developer->email ?? 'N/A' }}</td>
                        <td>
                            <a href="{{ route('developers.show', $developer->id) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('developers.edit', $developer->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('developers.destroy', $developer->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No developers found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
