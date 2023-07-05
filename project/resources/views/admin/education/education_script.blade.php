<script>
    //ajax code
    $(document).ready(function() {
        // Activate tooltip
        $('[data-toggle="tooltip"]').tooltip();

        //add Employee ajax
        $(document).on('click', '.addEducation', function(e) {
            e.preventDefault();
            let duration = $('#duration').val();
            let institute_name = $('#institute_name').val();
            let field = $('#field').val();
            let details = $('#details').val();
            $.ajax({
                url: "{{ route('add.education') }}",
                method: "post",
                data: {
                    duration: duration,
                    institute_name: institute_name,
                    field: field,
                    details: details,
                },
                success: function(res) {
                    if (res.status == "success") {
                        $("#addEducation").modal('hide');
                        $("#addEducationForm")[0].reset();
                        $(".table").load(location.href +
                            ' .table');
                        $('.errMsgContainer').html('');
                        toastr.success('Education Added Successfully');
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
        })

        //Data show Edit Education form
        $(document).on('click', '.edit', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            let duration = $(this).data('duration');
            let institute_name = $(this).data('institute_name');
            let field = $(this).data('field');
            let details = $(this).data('details');

            $('#up_id').val(id);
            $('#up_duration').val(duration);
            $('#up_institute_name').val(institute_name);
            $('#up_field').val(field);
            $('#up_details').val(details);
        })

        //Update data
        $(document).on('click', '.updateEducation', function(e) {
            e.preventDefault();
            let id = $('#up_id').val();
            let duration = $('#up_duration').val();
            let institute_name = $('#up_institute_name').val();
            let field = $('#up_field').val();
            let details = $('#up_details').val();

            $.ajax({
                url: "{{ route('update.education') }}",
                method: "patch",
                data: {
                    id: id,
                    duration: duration,
                    institute_name: institute_name,
                    field: field,
                    details: details,
                },
                success: function(res) {
                    if (res.status == "success") {
                        $("#editEducation").modal('hide');
                        $(".table").load(location.href +
                            ' .table');
                        $('.updateMsgContainer').html('');
                        toastr.info('Education Updated Successfully');
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
        $(document).on('click', '.deleteEducation', function(e) {
            e.preventDefault();
            let id = $('#del_id').val();

            $.ajax({
                url: "{{ route('delete.education') }}",
                method: "delete",
                data: {
                    id: id,
                },
                success: function(res) {
                    if (res.status == "success") {
                        $("#deleteEducation").modal('hide');
                        $(".table").load(location.href +
                            ' .table');
                        toastr.warning('Education Deleted Successfully');
                    }
                },
            });
        })

        function educationPagination(page) {
            $.ajax({
                url: "{{ url('/educations/education-data?page=') }}" + page,
                success: function(res) {
                    $('.education-data').html(res);
                },
            })
        }
        //pagination
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            let page = $(this).attr('href').split('page=')[1];
            educationPagination(page);
            console.log(page);
        })

        //search Employee ajax
        $(document).on('keyup', function(e) {
            e.preventDefault();
            let search_string = $('#search').val();
            $.ajax({
                url: "{{ route('search.education') }}",
                method: "get",
                data: {
                    search_string: search_string,
                },
                success: function(res) {
                    $('.education-data').html(res);
                    if (res.status == 'not-found') {
                        $('.education-data').html(
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
