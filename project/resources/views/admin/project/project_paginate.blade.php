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
                        <a href="#editProject" class="edit" data-toggle="modal" data-id="{{ $project->id }}"
                            data-title="{{ $project->title }}" data-preview_link="{{ $project->preview_link }}"
                            data-details="{{ $project->details }}"
                            data-thumbnail_link="{{ $project->thumbnail_link }}"><i class="fas fa-edit"
                                data-toggle="tooltip" title="Edit"></i></a>
                        <a href="#deleteProject" class="delete" data-toggle="modal" data-id="{{ $project->id }}"><i
                                class="fas fa-trash-alt" data-toggle="tooltip" title="Delete"></i></a>
                    @else
                        <a class="role_alert"><i class="fas fa-edit" data-toggle="tooltip" title="Edit"></i></a>
                        <a class="role_alert"><i class="fas fa-trash-alt" data-toggle="tooltip" title="Delete"></i></a>
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
