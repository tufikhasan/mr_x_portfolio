<script>
    //ajax code
    $(document).ready(function() {
        // Activate tooltip
        $('[data-toggle="tooltip"]').tooltip();

        //add Employee ajax
        $(document).on('click', '.addLanguage', function(e) {
            e.preventDefault();
            let name = $('#name').val();
            $.ajax({
                url: "{{ route('add.language') }}",
                method: "post",
                data: {
                    name: name,
                },
                success: function(res) {
                    if (res.status == "success") {
                        $("#addLanguage").modal('hide');
                        $("#addLanguageForm")[0].reset();
                        $(".table").load(location.href +
                            ' .table');
                        $('.errMsgContainer').html('');
                        toastr.success('Language Added Successfully');
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

        //Data show Edit Language form
        $(document).on('click', '.edit', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            let name = $(this).data('name');

            $('#up_id').val(id);
            $('#up_name').val(name);
        })

        //Update data
        $(document).on('click', '.updateLanguage', function(e) {
            e.preventDefault();
            let id = $('#up_id').val();
            let name = $('#up_name').val();

            $.ajax({
                url: "{{ route('update.language') }}",
                method: "patch",
                data: {
                    id: id,
                    name: name,
                },
                success: function(res) {
                    if (res.status == "success") {
                        $("#editLanguage").modal('hide');
                        $(".table").load(location.href +
                            ' .table');
                        $('.updateMsgContainer').html('');
                        toastr.info('Language Updated Successfully');
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
        $(document).on('click', '.deleteLanguage', function(e) {
            e.preventDefault();
            let id = $('#del_id').val();

            $.ajax({
                url: "{{ route('delete.language') }}",
                method: "delete",
                data: {
                    id: id,
                },
                success: function(res) {
                    if (res.status == "success") {
                        $("#deleteLanguage").modal('hide');
                        $(".table").load(location.href +
                            ' .table');
                        toastr.warning('Language Deleted Successfully');
                    }
                },
            });
        })

        function languagePagination(page) {
            $.ajax({
                url: "{{ url('/languages/language-data?page=') }}" + page,
                success: function(res) {
                    $('.language-data').html(res);
                },
            })
        }
        //pagination
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            let page = $(this).attr('href').split('page=')[1];
            languagePagination(page);
            console.log(page);
        })

        //search Employee ajax
        $(document).on('keyup', function(e) {
            e.preventDefault();
            let search_string = $('#search').val();
            $.ajax({
                url: "{{ route('search.language') }}",
                method: "get",
                data: {
                    search_string: search_string,
                },
                success: function(res) {
                    $('.language-data').html(res);
                    if (res.status == 'not-found') {
                        $('.language-data').html(
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
