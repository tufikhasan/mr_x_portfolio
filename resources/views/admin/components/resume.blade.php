@extends('admin.master')
@section('site_title', 'Resume')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800">Resume</h1>
    </div>
    <!-- Edit  -->
    <div class="row gutters">
        <div class="col-12">
            <div class="card">
                <form id="resume_section_form" class="card-body" enctype="multipart/form-data">
                    @csrf
                    <div class="row gutters">
                        <div class="col-12 updateMsgContainer">
                            {{-- error --}}
                        </div>
                        <input type="hidden" name="id" value="{{ $data->id }}">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Download Link</label>
                                <input type="url" class="form-control" id="link"
                                    value="{{ old('download_link', url('upload/resume/' . $data->download_link) ?? '') }}"
                                    disabled>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="download_link">Upload resume</label>
                                <input type="file" id="download_link" name="download_link">
                            </div>
                        </div>
                    </div>
                    <div class="row gutters mt-5">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="text-right">
                                <a class="btn btn-success" onclick="copyToClipboard('link')">Copy</a>
                                @if ('admin' == Auth::user()->role)
                                    <button type="submit" class="btn btn-primary">Update Resume</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        //input text copy function
        function copyToClipboard(id) {
            // Get the text field
            let copyText = document.getElementById(id);
            // Select the text field
            copyText.select();
            copyText.setSelectionRange(0, 99999); // For mobile devices
            // Copy the text inside the text field
            navigator.clipboard.writeText(copyText.value);
            toastr.success('Download link copied successfully.');
        }


        $(document).ready(function() {
            //update content
            $(document).on('submit', '#resume_section_form', function(e) {
                e.preventDefault();
                let formData = new FormData(this);
                $.ajax({
                        url: "{{ route('update.resume') }}",
                        method: "post",
                        data: formData,
                        cache: false,
                        processData: false,
                        contentType: false,
                        success: function(res) {
                            if (res.status == "success") {
                                $(".card").load(location.href + ' .card');
                                $('.updateMsgContainer').html('');
                                toastr.success('Resume Updated Successfully');
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
