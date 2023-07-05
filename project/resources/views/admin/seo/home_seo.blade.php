@extends('admin.master')
@section('site_title', 'Home Page')
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
        <h1 class="h4 mb-0 text-gray-800">Home Page</h1>
    </div>
    <!-- Edit  -->
    <div class="row gutters">
        <div class="col-12">
            <div class="card">
                <form id="seo_form" class="card-body" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $data->id }}">
                    <div class="row gutters">
                        <div class="col-12 updateMsgContainer">
                            {{-- error --}}
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" placeholder="Enter title"
                                    name="title" value="{{ old('title', $data->title ?? '') }}">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label for="keywords">Keywords</label><br>
                                <input type="text" class="form-control" id="keywords"
                                    value="{{ old('keywords', $data->keywords ?? 'DESIGN,DEVELOPMENT,MARKETING') }}"
                                    name="keywords" data-role="tagsinput">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" name="description" id="description" rows="5">{{ old('description', $data->description ?? '') }}</textarea>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label for="ogSiteName">Og Site Name</label>
                                <input type="text" class="form-control" id="ogSiteName" placeholder="Enter ogSiteName"
                                    name="ogSiteName" value="{{ old('ogSiteName', $data->ogSiteName ?? '') }}">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label for="ogUrl">Og URL</label>
                                <input type="text" class="form-control" id="ogUrl" placeholder="Enter ogUrl"
                                    name="ogUrl" value="{{ old('ogUrl', $data->ogUrl ?? '') }}">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label for="ogTitle">Og Title</label>
                                <input type="text" class="form-control" id="ogTitle" placeholder="Enter ogTitle"
                                    name="ogTitle" value="{{ old('ogTitle', $data->ogTitle ?? '') }}">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                            <div class="form-group">
                                <label for="ogDescription">Og Description</label>
                                <textarea class="form-control" name="ogDescription" id="ogDescription" rows="5">{{ old('ogDescription', $data->ogDescription ?? '') }}</textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="ogImage">Og Image</label>
                                <input type="file" id="ogImage" name="ogImage">
                            </div>
                        </div>
                        <div class="col-12">
                            <img style="width: 120px;"
                                src="{{ !empty($data->ogImage) ? url('upload/seo/' . $data->ogImage) : url('upload/no_image.jpg') }}"
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
            $("#ogImage").change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });

            //update home seo
            $(document).on('submit', '#seo_form', function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                $.ajax({
                        url: "{{ route('update.seo') }}",
                        method: "post",
                        data: formData,
                        cache: false,
                        processData: false,
                        contentType: false,
                        success: function(res) {
                            if (res.status == "success") {
                                $(".card").load(location.href + ' .card');
                                $('.updateMsgContainer').html('');
                                toastr.success('Seo Properties Updated Successfully');
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
