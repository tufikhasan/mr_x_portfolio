@extends('admin.master')
@section('site_title', 'Projects')
@section('content')
    <!-- Edit  -->
    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2>All <b>Project</b></h2>
                        </div>
                        <div class="col-sm-6">
                            <a href="#addProject" class="btn btn-success" data-toggle="modal"><i class="fas fa-plus"></i>
                                <span>Add New Project</span></a>
                        </div>
                    </div>
                </div>
                <input type="text" name="search" id="search" class="form-control mb-3" placeholder="Search Project">
                <div class="project-data">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Sl-No:</th>
                                <th>Title</th>
                                <th>Preview Link</th>
                                <th>Image</th>
                                <th>Details</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($projects as $key => $project)
                                <tr>
                                    <td>{{ $key + 1 < 10 ? '0' . $key + 1 : $key + 1 }}</td>
                                    <td>{{ $project->title }}</td>
                                    <td>{{ $project->preview_link }}</td>
                                    <td><img style="width: 50px"
                                            src="{{ !empty($project->thumbnail_link) ? url('upload/project/' . $project->thumbnail_link) : url('upload/no_image.jpg') }}"
                                            alt="{{ $project->title }}" /></td>
                                    <td>{{ $project->details }}</td>
                                    <td class="d-flex">
                                        @if ('admin' == Auth::user()->role)
                                            <a href="#editProject" class="edit" data-toggle="modal"
                                                data-id="{{ $project->id }}" data-title="{{ $project->title }}"
                                                data-preview_link="{{ $project->preview_link }}"
                                                data-details="{{ $project->details }}"
                                                data-thumbnail_link="{{ $project->thumbnail_link }}"><i class="fas fa-edit"
                                                    data-toggle="tooltip" title="Edit"></i></a>
                                            <a href="#deleteProject" class="delete" data-toggle="modal"
                                                data-id="{{ $project->id }}"><i class="fas fa-trash-alt"
                                                    data-toggle="tooltip" title="Delete"></i></a>
                                        @else
                                            <a class="role_alert"><i class="fas fa-edit" data-toggle="tooltip"
                                                    title="Edit"></i></a>
                                            <a class="role_alert"><i class="fas fa-trash-alt" data-toggle="tooltip"
                                                    title="Delete"></i></a>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">
                                        <img class="float-center" src="{{ asset('upload/empty.jpg') }}"><br>
                                        <h6 class="mb-2 text-center"><b class="text-danger">No data found</h6>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="clearfix">
                        {!! $projects->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Add Modal HTML -->
    <div id="addProject" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="addProjectForm" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Add Project</h4>
                        <button type="button" class="close modal-close" data-dismiss="modal" aria-hidden="true">
                            &times;
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="errMsgContainer">
                            <!--Error message area-->
                        </div>
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" />
                        </div>
                        <div class="form-group">
                            <label for="preview_link">Preview Llink</label>
                            <input type="text" class="form-control" id="preview_link" name="preview_link" />
                        </div>
                        <div class="form-group">
                            <label for="details">Details</label>
                            <textarea class="form-control" id="details" rows="5" name="details"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="thumbnail_link">Image</label>
                            <input type="file" id="thumbnail_link" name="thumbnail_link">
                        </div>
                        <div class="col-12">
                            <img style="width: 120px;" src="{{ url('upload/no_image.jpg') }}" id="showImage">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default modal-close" data-dismiss="modal" value="Cancel" />
                        <input type="submit" class="btn btn-success" value="Add" />
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Edit Modal HTML -->
    <div id="editProject" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="updateProjectForm" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Project</h4>
                        <button type="button" class="close modal-close" data-dismiss="modal" aria-hidden="true">
                            &times;
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="updateMsgContainer">
                            <!--Error message area-->
                        </div>
                        <input type="hidden" name="id" id="up_id">
                        <div class="form-group">
                            <label for="up_title">Title</label>
                            <input type="text" class="form-control" id="up_title" name="title" />
                        </div>
                        <div class="form-group">
                            <label for="up_preview_link">Preview Llink</label>
                            <input type="text" class="form-control" id="up_preview_link" name="preview_link" />
                        </div>
                        <div class="form-group">
                            <label for="up_details">Details</label>
                            <textarea class="form-control" id="up_details" rows="5" name="details"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="up_thumbnail_link">Image</label>
                            <input type="file" id="up_thumbnail_link" name="thumbnail_link">
                        </div>
                        <div class="col-12">
                            <img style="width: 120px;" src="{{ url('upload/no_image.jpg') }}" id="up_showImage">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default modal-close" data-dismiss="modal" value="Cancel" />
                        <input type="submit" class="btn btn-info" value="Update" />
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Delete Modal HTML -->
    <div id="deleteProject" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="deleteProjectForm">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Delete Project</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            &times;
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete these Records?</p>
                        <input type="hidden" id="del_id">
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel" />
                        <input type="submit" class="btn btn-danger deleteProject" value="Delete" />
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('admin.project.project_script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#thumbnail_link").change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
        $(document).ready(function() {
            $("#up_thumbnail_link").change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#up_showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endsection
