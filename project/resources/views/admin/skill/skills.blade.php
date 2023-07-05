@extends('admin.master')
@section('site_title', 'Skills')
@section('content')
    <!-- Edit  -->
    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2>All <b>Skill</b></h2>
                        </div>
                        <div class="col-sm-6">
                            <a href="#addSkill" class="btn btn-success" data-toggle="modal"><i class="fas fa-plus"></i>
                                <span>Add New Skill</span></a>
                        </div>
                    </div>
                </div>
                <input type="text" name="search" id="search" class="form-control mb-3" placeholder="Search skill">
                <div class="skill-data">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Sl-No:</th>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($skills as $key => $skill)
                                <tr>
                                    <td>{{ $key + 1 < 10 ? '0' . $key + 1 : $key + 1 }}</td>
                                    <td>{{ $skill->name }}</td>
                                    <td class="d-flex">
                                        @if ('admin' == Auth::user()->role)
                                            <a href="#editSkill" class="edit" data-toggle="modal"
                                                data-id="{{ $skill->id }}" data-name="{{ $skill->name }}"><i
                                                    class="fas fa-edit" data-toggle="tooltip" title="Edit"></i></a>
                                            <a href="#deleteSkill" class="delete" data-toggle="modal"
                                                data-id="{{ $skill->id }}"><i class="fas fa-trash-alt"
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
                                    <td colspan="3" class="text-center">
                                        <img class="float-center" src="{{ asset('upload/empty.jpg') }}"><br>
                                        <h6 class="mb-2 text-center"><b class="text-danger">No data found</h6>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="clearfix">
                        {!! $skills->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Add Modal HTML -->
    <div id="addSkill" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="addSkillForm">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Add Skill</h4>
                        <button type="button" class="close modal-close" data-dismiss="modal" aria-hidden="true">
                            &times;
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="errMsgContainer">
                            <!--Error message area-->
                        </div>
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" id="name" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default modal-close" data-dismiss="modal" value="Cancel" />
                        <input type="submit" class="btn btn-success addSkill" value="Add" />
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Edit Modal HTML -->
    <div id="editSkill" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Skill</h4>
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
                            <label>Name</label>
                            <input type="text" class="form-control" id="up_name" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default modal-close" data-dismiss="modal" value="Cancel" />
                        <input type="submit" class="btn btn-info updateSkill" value="Update" />
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Delete Modal HTML -->
    <div id="deleteSkill" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Delete Skill</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            &times;
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete these Records?</p>
                        {{-- <p class="text-warning">
                            <small>This action cannot be undone.</small>
                        </p> --}}
                        <input type="hidden" id="del_id" name="del_id">
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel" />
                        <input type="submit" class="btn btn-danger deleteSkill" value="Delete" />
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('admin.skill.skill_script')
@endsection
