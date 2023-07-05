<script>
    //ajax code
    $(document).ready(function() {
        // Activate tooltip
        $('[data-toggle="tooltip"]').tooltip();

        //add Employee ajax
        $(document).on('submit', '#addProjectForm', function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            $.ajax({
                url: "{{ route('add.project') }}",
                method: "post",
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function(res) {
                    if (res.status == "success") {
                        $("#addProjectForm")[0].reset();
                        $(".table").load(location.href + ' .table');
                        $("#addProject").modal('hide');
                        $('.errMsgContainer').html('');
                        $("#showImage").attr("src", "{{ url('upload/no_image.jpg') }}");
                        toastr.success('Project Added Successfully');
                    }
                },
                error: function(err) {
                    $('.errMsgContainer').html('');
                    let error = err.responseJSON;
                    $.each(error.errors, function(index, value) {
                        $('.errMsgContainer').append(
                            `<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                ${value}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div><br>`
                        )
                    })
                }
            })
        })

        //blank error message container
        $(document).on('click', '.modal-close', function(e) {
            $('.errMsgContainer').html('');
            $("#showImage").attr("src", "{{ url('upload/no_image.jpg') }}");
            $("#up_showImage").attr("src", "{{ url('upload/no_image.jpg') }}");
        })

        //Data show Edit skill form
        $(document).on('click', '.edit', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            let title = $(this).data('title');
            let preview_link = $(this).data('preview_link');
            let details = $(this).data('details');
            let thumbnail_link = $(this).data('thumbnail_link');

            $('#up_id').val(id);
            $('#up_title').val(title);
            $('#up_preview_link').val(preview_link);
            $('#up_details').val(details);

            let imageUrl = thumbnail_link ? `upload/project/${thumbnail_link}` : "upload/no_image.jpg";
            $("#up_showImage").attr("src", imageUrl);
        })

        //Update data
        $(document).on('submit', '#updateProjectForm', function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            $.ajax({
                url: "{{ route('update.project') }}",
                method: "post",
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                success: function(res) {
                    if (res.status == "success") {
                        $("#updateProjectForm")[0].reset();
                        $(".table").load(location.href + ' .table');
                        $("#editProject").modal('hide');
                        $('.updateMsgContainer').html('');
                        $("#up_showImage").attr("src", "{{ url('upload/no_image.jpg') }}");
                        toastr.success('Project Updated Successfully');
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
            });
        })

        //id show delete modal
        $(document).on('click', '.delete', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            $('#del_id').val(id);
        })

        //delete data
        $(document).on('click', '#deleteProjectForm', function(e) {
            e.preventDefault();
            let id = $('#del_id').val();

            $.ajax({
                url: "{{ route('delete.project') }}",
                method: "delete",
                data: {
                    id: id,
                },
                success: function(res) {
                    if (res.status == "success") {
                        $("#deleteProject").modal('hide');
                        $(".table").load(location.href +
                            ' .table');
                        toastr.success('Project Deleted Successfully');
                    }
                },
            });
        })

        function skillPagination(page) {
            $.ajax({
                url: "{{ url('/projects-data?page=') }}" + page,
                success: function(res) {
                    $('.project-data').html(res);
                },
            })
        }
        //pagination
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            let page = $(this).attr('href').split('page=')[1];
            skillPagination(page);
        })

        //search Employee ajax
        $(document).on('keyup', function(e) {
            e.preventDefault();
            let search_string = $('#search').val();
            $.ajax({
                url: "{{ route('search.project') }}",
                method: "get",
                data: {
                    search_string: search_string,
                },
                success: function(res) {
                    $('.project-data').html(res);
                    if (res.status == 'not-found') {
                        $('.project-data').html(
                            `<div class="text-center">
                                <img class="float-center" src="{{ asset('upload/no_found.jpg') }}"><br>
                                <h6 class="mb-2 text-dager text-center">Nothing found data = <b class="text-info">${search_string}</h6>
                            </div>`
                        );
                    }
                },
            })
        })
    });
</script>
