@extends('admin.master')
@section('site_title', 'Educations')
@section('content')
    <!-- Edit  -->
    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2>All <b>Educations</b></h2>
                        </div>
                        <div class="col-sm-6">
                            <a href="#addEducation" class="btn btn-success" data-toggle="modal"><i class="fas fa-plus"></i>
                                <span>Add Education</span></a>
                        </div>
                    </div>
                </div>
                <input type="text" name="search" id="search" class="form-control mb-3"
                    placeholder="Search Education">
                <div class="education-data">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Sl-No:</th>
                                <th>Duration</th>
                                <th>Institute name</th>
                                <th>Field name</th>
                                <th>Details</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($educations as $key => $education)
                                <tr>
                                    <td>{{ $key + 1 < 10 ? '0' . $key + 1 : $key + 1 }}</td>
                                    <td>{{ $education->duration }}</td>
                                    <td>{{ $education->institute_name }}</td>
                                    <td>{{ $education->field }}</td>
                                    <td>{{ $education->details }}</td>
                                    <td class="d-flex">
                                        @if ('admin' == Auth::user()->role)
                                            <a href="#editEducation" class="edit" data-toggle="modal"
                                                data-id="{{ $education->id }}" data-duration="{{ $education->duration }}"
                                                data-institute_name="{{ $education->institute_name }}"
                                                data-field="{{ $education->field }}"
                                                data-details="{{ $education->details }}"><i class="fas fa-edit"
                                                    data-toggle="tooltip" title="Edit"></i></a>
                                            <a href="#deleteEducation" class="delete" data-toggle="modal"
                                                data-id="{{ $education->id }}"><i class="fas fa-trash-alt"
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
                        {!! $educations->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Add Modal HTML -->
    <div id="addEducation" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="addEducationForm">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Add Education</h4>
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
                            <label for="institute_name">Institute name</label>
                            <input type="text" class="form-control" id="institute_name" />
                        </div>
                        <div class="form-group">
                            <label for="field">Field</label>
                            <input type="text" class="form-control" id="field" />
                        </div>
                        <div class="form-group">
                            <label for="details">Details</label>
                            <textarea class="form-control" id="details" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default modal-close" data-dismiss="modal" value="Cancel" />
                        <input type="submit" class="btn btn-success addEducation" value="Add" />
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Edit Modal HTML -->
    <div id="editEducation" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Education</h4>
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
                            <label for="institute_name">Institute name</label>
                            <input type="text" class="form-control" id="up_institute_name" />
                        </div>
                        <div class="form-group">
                            <label for="field">Field</label>
                            <input type="text" class="form-control" id="up_field" />
                        </div>
                        <div class="form-group">
                            <label for="details">Details</label>
                            <textarea class="form-control" id="up_details" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default modal-close" data-dismiss="modal" value="Cancel" />
                        <input type="submit" class="btn btn-info updateEducation" value="Update" />
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Delete Modal HTML -->
    <div id="deleteEducation" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Delete Education</h4>
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
                        <input type="submit" class="btn btn-danger deleteEducation" value="Delete" />
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('admin.education.education_script')
@endsection
