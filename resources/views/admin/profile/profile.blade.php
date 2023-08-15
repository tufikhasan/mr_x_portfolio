@extends('admin.master')
@section('site_title', "$adminData->name - Profile")
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800">Profile</h1>
    </div>
    <!-- Info  -->
    <div class="profile_content">
        <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="{{ !empty($adminData->profile_image) ? url('upload/admin_images/' . $adminData->profile_image) : url('upload/avatar.png') }}"
                                alt="{{ $adminData->name }}" class="rounded-circle" width="150">
                            <div class="mt-3">
                                <h4>{{ $adminData->name }}</h4>
                                <p class="text-secondary mb-1">Full Stack Developer</p>
                                <p class="text-muted font-size-sm">Bogura, Bangladesh</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Id</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ $adminData->id }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Full Name</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ $adminData->name }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Email</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                                {{ $adminData->email }}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12">
                                <a class="btn btn-info " href="#editProfile" data-toggle="modal">Edit</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Edit Modal HTML -->
    <div id="editProfile" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="profile_section_form" class="card-body" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Profile</h4>
                        <button type="button" class="close modal-close" data-dismiss="modal" aria-hidden="true">
                            &times;
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 updateMsgContainer">
                                {{-- error --}}
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="fullName">Full Name</label>
                                    <input type="text" class="form-control" id="fullName" placeholder="Enter full name"
                                        name="name" value="{{ old('name', $adminData->name ?? '') }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="eMail">Email</label>
                                    <input type="email" class="form-control" id="eMail" placeholder="Enter email ID"
                                        name="email" value="{{ old('name', $adminData->email ?? '') }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="profile_image">Profile Image</label>
                                    <input type="file" id="profile_image" name="profile_image">
                                </div>
                            </div>
                            <div class="col-12">
                                <img style="width: 120px;"
                                    src="{{ !empty($adminData->profile_image) ? url('upload/admin_images/' . $adminData->profile_image) : url('upload/avatar.png') }}"
                                    alt="{{ $adminData->name }}" id="showImage">

                            </div>
                        </div>
                    </div>

                    <div class="row gutters mt-5">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="text-right">
                                @if ('admin' == Auth::user()->role)
                                    <button type="submit" class="btn btn-primary">Update Info</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#profile_image").change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });

        //update content
        $(document).on('submit', '#profile_section_form', function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                    url: "{{ route('update.profile') }}",
                    method: "post",
                    data: formData,
                    cache: false,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        if (res.status == "success") {
                            $("#editProfile").modal('hide');
                            $(".profile_content").load(location.href + ' .profile_content');
                            $('.updateMsgContainer').html('');
                            toastr.success('Profile Updated Successfully');
                        }
                    },
                    error: function(err) {
                        $('.updateMsgContainer').html('');
                        let error = err.responseJSON;
                        $.each(error.errors, function(index, value) {
                            $('.updateMsgContainer').append(
                                `<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                ${value}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div><br>`
                            )
                        })
                    }
                }

            )
        });
    </script>
@endsection
