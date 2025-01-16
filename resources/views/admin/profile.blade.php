@extends('admin.layouts.app')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Profile</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('admin.dashboard') }}" style="background-color: #4f9190;border-color: #4f9190" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <form action="" method="POST" id="userForm" name="userForm" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $users->name }}">
                                <p class="error"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="mobile">Mobile</label>
                                <input type="text" name="mobile" id="mobile" class="form-control" value="{{ $users->mobile }}">
                                <p class="error"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="password">New Password</label>
                                <input type="password" name="password" id="password" class="form-control">
                                <p class="error"></p>
                                <!-- Indicate that a password is already set -->
                                <small class="form-text text-muted">Leave blank to keep the current password.</small>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="image">Profile Image</label>

                                <!-- Custom-styled file input button -->
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="image" name="image" onchange="updateFileName(this)">
                                        <label class="custom-file-label" for="image">Choose file</label>
                                    </div>
                                </div>
                                <p class="error"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pb-5 pt-3">
                <button type="submit" style="background-color: #4f9190;border-color: #4f9190" class="btn btn-primary">Update</button>
            </div>
        </div>
    </form>

    <!-- /.card -->
</section>
<!-- /.content -->
@endsection

@section('customJs')
<script>
    $("#userForm").submit(function(event) {
        event.preventDefault();
        var formData = new FormData(this);
        $("button[type=submit]").prop('disabled', true);
        $.ajax({
            url: '{{ route("admin.profile.update", $users->id) }}',
            type: 'POST', // Changed from 'PUT' to 'POST'
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                $("button[type=submit]").prop('disabled', false);
                if (response.status == true) {
                    window.location.href = "{{ route('admin.dashboard') }}";
                } else {
                    var errors = response.errors;
                    $(".error").removeClass('is-invalid').html('');
                    $("input[type='text'], input[type='file'], select").removeClass('is-invalid');
                    $.each(errors, function(key, value) {
                        $("#" + key).addClass('is-invalid');
                        $("#" + key).next('p').addClass('invalid-feedback').html(value);
                    });
                }
            },
            error: function(jqXHR, exception) {
                console.log("Something went wrong");
            }
        });
    });
</script>
<script>
    function updateFileName(input) {
        var fileName = input.files[0].name;
        $(input).next('.custom-file-label').html(fileName);
    }
</script>
@endsection