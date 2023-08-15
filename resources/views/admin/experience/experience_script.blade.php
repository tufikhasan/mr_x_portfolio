<script>
    //ajax code
    $(document).ready(function() {
        // Activate tooltip
        $('[data-toggle="tooltip"]').tooltip();

        //add Employee ajax
        $(document).on('click', '.addExperience', function(e) {
            e.preventDefault();
            let duration = $('#duration').val();
            let title = $('#title').val();
            let designation = $('#designation').val();
            let details = $('#details').val();
            $.ajax({
                url: "{{ route('add.experience') }}",
                method: "post",
                data: {
                    duration: duration,
                    title: title,
                    designation: designation,
                    details: details,
                },
                success: function(res) {
                    if (res.status == "success") {
                        $("#addExperience").modal('hide');
                        $("#addExperienceForm")[0].reset();
                        $(".table").load(location.href +
                            ' .table');
                        $('.errMsgContainer').html('');
                        toastr.success('Experience Added Successfully');
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

        //Data show Edit Experience form
        $(document).on('click', '.edit', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            let duration = $(this).data('duration');
            let title = $(this).data('title');
            let designation = $(this).data('designation');
            let details = $(this).data('details');

            $('#up_id').val(id);
            $('#up_duration').val(duration);
            $('#up_title').val(title);
            $('#up_designation').val(designation);
            $('#up_details').val(details);
        })

        //Update data
        $(document).on('click', '.updateExperience', function(e) {
            e.preventDefault();
            let id = $('#up_id').val();
            let duration = $('#up_duration').val();
            let title = $('#up_title').val();
            let designation = $('#up_designation').val();
            let details = $('#up_details').val();

            $.ajax({
                url: "{{ route('update.experience') }}",
                method: "patch",
                data: {
                    id: id,
                    duration: duration,
                    title: title,
                    designation: designation,
                    details: details,
                },
                success: function(res) {
                    if (res.status == "success") {
                        $("#editExperience").modal('hide');
                        $(".table").load(location.href +
                            ' .table');
                        $('.updateMsgContainer').html('');
                        toastr.info('Experience Updated Successfully');
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
        $(document).on('click', '.deleteExperience', function(e) {
            e.preventDefault();
            let id = $('#del_id').val();

            $.ajax({
                url: "{{ route('delete.experience') }}",
                method: "delete",
                data: {
                    id: id,
                },
                success: function(res) {
                    if (res.status == "success") {
                        $("#deleteExperience").modal('hide');
                        $(".table").load(location.href +
                            ' .table');
                        toastr.warning('Experience Deleted Successfully');
                    }
                },
            });
        })

        function experiencePagination(page) {
            $.ajax({
                url: "{{ url('/experiences/experience-data?page=') }}" + page,
                success: function(res) {
                    $('.experience-data').html(res);
                },
            })
        }
        //pagination
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            let page = $(this).attr('href').split('page=')[1];
            experiencePagination(page);
            console.log(page);
        })

        //search Employee ajax
        $(document).on('keyup', function(e) {
            e.preventDefault();
            let search_string = $('#search').val();
            $.ajax({
                url: "{{ route('search.experience') }}",
                method: "get",
                data: {
                    search_string: search_string,
                },
                success: function(res) {
                    $('.experience-data').html(res);
                    if (res.status == 'not-found') {
                        $('.experience-data').html(
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
