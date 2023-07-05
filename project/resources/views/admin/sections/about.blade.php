@extends('admin.master')
@section('site_title', 'About Info')
@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800">About Info</h1>
    </div>
    <!-- Edit  -->
    <div class="row gutters">
        <div class="col-12">
            <div class="card">
                <form class="card-body">
                    @csrf
                    <div class="row gutters">
                        <div class="col-12 updateMsgContainer">
                            {{-- error --}}
                        </div>
                        <input type="hidden" id="id" value="{{ $data->id }}">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" placeholder="Enter title"
                                    value="{{ old('title', $data->title ?? '') }}">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="details">Details</label>
                                <textarea class="form-control" id="details" rows="5">{{ old('details', $data->details ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row gutters mt-5">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="text-right">
                                @if ('admin' == Auth::user()->role)
                                    <button type="submit" class="btn btn-primary updateInfo">Update Info</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        //update content
        $(document).on('click', '.updateInfo', function(e) {
            e.preventDefault();
            let id = $('#id').val();
            let title = $('#title').val();
            let details = $('#details').val();
            $.ajax({
                    url: "{{ route('update.about') }}",
                    method: "patch",
                    data: {
                        id: id,
                        title: title,
                        details: details,
                    },
                    success: function(res) {
                        if (res.status == "success") {
                            $(".card").load(location.href + ' .card');
                            $('.updateMsgContainer').html('');
                            toastr.success('About Info Updated Successfully');
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
