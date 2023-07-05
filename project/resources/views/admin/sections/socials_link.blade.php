@extends('admin.master')
@section('site_title', 'Social Link')
@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h4 mb-0 text-gray-800">Social Link</h1>
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
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="twitter_link">Twitter Link</label>
                                <input type="text" class="form-control" id="twitter_link"
                                    placeholder="Enter twitter link"
                                    value="{{ old('twitter_link', $data->twitter_link ?? '') }}">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="github_link">Github Link</label>
                                <input type="text" class="form-control" id="github_link" placeholder="Enter github link"
                                    value="{{ old('github_link', $data->github_link ?? '') }}">
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="linkedin_link">linkedIn Link</label>
                                <input type="text" class="form-control" id="linkedin_link"
                                    placeholder="Enter linkedin link"
                                    value="{{ old('linkedin_link', $data->linkedin_link ?? '') }}">
                            </div>
                        </div>
                    </div>
                    <div class="row gutters mt-5">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="text-right">
                                @if ('admin' == Auth::user()->role)
                                    <button type="submit" class="btn btn-primary updateInfo">Update</button>
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
            let twitter_link = $('#twitter_link').val();
            let github_link = $('#github_link').val();
            let linkedin_link = $('#linkedin_link').val();
            $.ajax({
                    url: "{{ route('update.social') }}",
                    method: "patch",
                    data: {
                        id: id,
                        twitter_link: twitter_link,
                        github_link: github_link,
                        linkedin_link: linkedin_link,
                    },
                    success: function(res) {
                        if (res.status == "success") {
                            $(".card").load(location.href + ' .card');
                            $('.updateMsgContainer').html('');
                            toastr.success('Social Link Updated Successfully');
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
