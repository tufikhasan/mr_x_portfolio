@extends('admin.master')
@section('site_title', 'Change Password')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800">Change Password</h1>
    </div>
    <!-- Edit  -->
    <div class="row gutters">
        <div class="col-12">
            <div class="card">
                <form class="card-body" method="POST" action="{{ route('update.password') }}">
                    @csrf
                    @method('patch')
                    <div class="row gutters">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            @if (count($errors))
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ $error }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="old_password">Old Password</label>
                                <input type="password" class="form-control" id="old_password"
                                    placeholder="Enter your old password" name="old_password"
                                    value="{{ old('old_password', $old_password ?? '') }}">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="new_password">New Password</label>
                                <input type="password" class="form-control" id="new_password"
                                    placeholder="Enter your new password" name="new_password"
                                    value="{{ old('new_password', $new_password ?? '') }}">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="confirm_password">Confirm Password</label>
                                <input type="password" class="form-control" id="confirm_password"
                                    placeholder="Confirmation your new password" name="confirm_password"
                                    value="{{ old('confirm_password', $confirm_password ?? '') }}">
                            </div>
                        </div>
                    </div>
                    <div class="row gutters mt-5">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">Change Password</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
