@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit Developer</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label"> Developer Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="mobile" class="form-label">User Id</label>
            <input type="text" name="mobile" id="mobile" class="form-control" value="{{ old('mobile', $user->mobile) }}" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control">
            <small class="form-text text-muted">Leave blank to keep the current password.</small>
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
        </div>

        <div class="mb-3">
            <label for="role" class="form-label">Role</label>
            <select name="role" id="role" class="form-control" required>
                @foreach($roles as $id => $name)
                    <option value="{{ $id }}" {{ $user->role == $id ? 'selected' : '' }}>
                        {{ $name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Profile Image</label>
            <input type="file" name="image" id="image" class="form-control" accept="image/*">
            @if ($user->image)
                <p>Current Image:</p>
                <img src="{{ asset('storage/' . $user->image) }}" alt="Profile Image" class="img-thumbnail" style="width: 100px;">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Update Developer</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
