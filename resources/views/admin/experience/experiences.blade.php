@extends('admin.master')
@section('site_title', 'Experiences')
@section('content')
    <!-- Edit  -->
    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2>All <b>Experiences</b></h2>
                        </div>
                        <div class="col-sm-6">
                            <a href="#addExperience" class="btn btn-success" data-toggle="modal"><i class="fas fa-plus"></i>
                                <span>Add Experience</span></a>
                        </div>
                    </div>
                </div>
                <input type="text" name="search" id="search" class="form-control mb-3"
                    placeholder="Search Experience">
                <div class="experience-data">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Sl-No:</th>
                                <th>Duration</th>
                                <th>Title</th>
                                <th>Designation name</th>
                                <th>Details</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($experiences as $key => $experience)
                                <tr>
                                    <td>{{ $key + 1 < 10 ? '0' . $key + 1 : $key + 1 }}</td>
                                    <td>{{ $experience->duration }}</td>
                                    <td>{{ $experience->title }}</td>
                                    <td>{{ $experience->designation }}</td>
                                    <td>{{ $experience->details }}</td>
                                    <td class="d-flex">
                                        @if ('admin' == Auth::user()->role)
                                            <a href="#editExperience" class="edit" data-toggle="modal"
                                                data-id="{{ $experience->id }}" data-duration="{{ $experience->duration }}"
                                                data-title="{{ $experience->title }}"
                                                data-designation="{{ $experience->designation }}"
                                                data-details="{{ $experience->details }}"><i class="fas fa-edit"
                                                    data-toggle="tooltip" title="Edit"></i></a>
                                            <a href="#deleteExperience" class="delete" data-toggle="modal"
                                                data-id="{{ $experience->id }}"><i class="fas fa-trash-alt"
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
                        {!! $experiences->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Add Modal HTML -->
    <div id="addExperience" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="addExperienceForm">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Add Experience</h4>
                        <button type="button" class="close modal-close" data-dismiss="modal" aria-hidden="true">
                            &times;
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="errMsgContainer">
                            <!--Error message area-->
                        </div>
                        <div class="form-group">
                            <label for="duration">Duration</label>
                            <input type="text" class="form-control" id="duration" placeholder="2017 - 2019" />
                        </div>
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" />
                        </div>
                        <div class="form-group">
                            <label for="designation">Designation</label>
                            <input type="text" class="form-control" id="designation" />
                        </div>
                        <div class="form-group">
                            <label for="details">Details</label>
                            <textarea class="form-control" id="details" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default modal-close" data-dismiss="modal" value="Cancel" />
                        <input type="submit" class="btn btn-success addExperience" value="Add" />
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Edit Modal HTML -->
    <div id="editExperience" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Experience</h4>
                        <button type="button" class="close modal-close" data-dismiss="modal" aria-hidden="true">
                            &times;
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="updateMsgContainer">
                            <!--Error message area-->
                        </div>
                        <input type="hidden" name="up_id" id="up_id">
                        <div class="form-group">
                            <label for="duration">Duration</label>
                            <input type="text" class="form-control" id="up_duration" placeholder="2017 - 2019" />
                        </div>
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="up_title" />
                        </div>
                        <div class="form-group">
                            <label for="designation">Designation</label>
                            <input type="text" class="form-control" id="up_designation" />
                        </div>
                        <div class="form-group">
                            <label for="details">Details</label>
                            <textarea class="form-control" id="up_details" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default modal-close" data-dismiss="modal" value="Cancel" />
                        <input type="submit" class="btn btn-info updateExperience" value="Update" />
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Delete Modal HTML -->
    <div id="deleteExperience" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Delete Experience</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            &times;
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete these Records?</p>
                        <input type="hidden" id="del_id" name="del_id">
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel" />
                        <input type="submit" class="btn btn-danger deleteExperience" value="Delete" />
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('admin.experience.experience_script')
@endsection
