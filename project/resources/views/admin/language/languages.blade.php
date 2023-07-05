@extends('admin.master')
@section('site_title', 'Languages')
@section('content')
    <!-- Edit  -->
    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2>All <b>Language</b></h2>
                        </div>
                        <div class="col-sm-6">
                            <a href="#addLanguage" class="btn btn-success" data-toggle="modal"><i class="fas fa-plus"></i>
                                <span>Add New Language</span></a>
                        </div>
                    </div>
                </div>
                <input type="text" name="search" id="search" class="form-control mb-3" placeholder="Search Language">
                <div class="language-data">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Sl-No:</th>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($languages as $key => $language)
                                <tr>
                                    <td>{{ $key + 1 < 10 ? '0' . $key + 1 : $key + 1 }}</td>
                                    <td>{{ $language->name }}</td>
                                    <td class="d-flex">
                                        @if ('admin' == Auth::user()->role)
                                            <a href="#editLanguage" class="edit" data-toggle="modal"
                                                data-id="{{ $language->id }}" data-name="{{ $language->name }}"><i
                                                    class="fas fa-edit" data-toggle="tooltip" title="Edit"></i></a>
                                            <a href="#deleteLanguage" class="delete" data-toggle="modal"
                                                data-id="{{ $language->id }}"><i class="fas fa-trash-alt"
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
                        {!! $languages->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Add Modal HTML -->
    <div id="addLanguage" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="addLanguageForm">
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Add Language</h4>
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
                        <input type="submit" class="btn btn-success addLanguage" value="Add" />
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Edit Modal HTML -->
    <div id="editLanguage" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Language</h4>
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
                        <input type="submit" class="btn btn-info updateLanguage" value="Update" />
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Delete Modal HTML -->
    <div id="deleteLanguage" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Delete Language</h4>
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
                        <input type="submit" class="btn btn-danger deleteLanguage" value="Delete" />
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('admin.language.language_script')
@endsection
