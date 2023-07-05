@extends('admin.master')
@section('site_title', 'Hero Properties')
@section('content')
    <style type="text/css">
        .bootstrap-tagsinput .tag {
            margin-right: 2px;
            color: #00808e;
            font-weight: 700px;
        }
    </style>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800">Hero Properties</h1>
    </div>
    <!-- Edit  -->
    <div class="row gutters">
        <div class="col-12">
            <div class="card">
                <form id="hero_section_form" class="card-body" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row gutters">
                        <div class="col-12 updateMsgContainer">
                            {{-- error --}}
                        </div>
                        <input type="hidden" name="id" value="{{ $data->id }}">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="key_line">Key Line</label><br>
                                <input type="text" class="form-control" id="key_line"
                                    value="{{ old('key_line', $data->key_line ?? 'DESIGN,DEVELOPMENT,MARKETING') }}"
                                    name="key_line" data-role="tagsinput">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="short_title">Short title</label>
                                <input type="text" class="form-control" id="short_title"
                                    value="{{ old('short_title', $data->short_title ?? '') }}" name="short_title">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" placeholder="Enter title"
                                    name="title" value="{{ old('title', $data->title ?? '') }}">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" id="image" name="image">
                            </div>
                        </div>
                        <div class="col-12">
                            <img style="width: 120px;"
                                src="{{ !empty($data->image) ? url('upload/about/' . $data->image) : url('upload/no_image.jpg') }}"
                                alt="{{ $data->name }}" id="showImage">

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
            //show image
            $("#image").change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });

            //update content
            $(document).on('submit', '#hero_section_form', function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                $.ajax({
                        url: "{{ route('update.heroProperty') }}",
                        method: "post",
                        data: formData,
                        cache: false,
                        processData: false,
                        contentType: false,
                        success: function(res) {
                            if (res.status == "success") {
                                $(".card").load(location.href + ' .card');
                                $('.updateMsgContainer').html('');
                                toastr.success('Hero Properties Updated Successfully');
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
        });
    </script>
@endsection
