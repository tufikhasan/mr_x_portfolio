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
                        <a href="#editExperience" class="edit" data-toggle="modal" data-id="{{ $experience->id }}"
                            data-duration="{{ $experience->duration }}" data-title="{{ $experience->title }}"
                            data-designation="{{ $experience->designation }}" data-details="{{ $experience->details }}"><i
                                class="fas fa-edit" data-toggle="tooltip" title="Edit"></i></a>
                        <a href="#deleteExperience" class="delete" data-toggle="modal"
                            data-id="{{ $experience->id }}"><i class="fas fa-trash-alt" data-toggle="tooltip"
                                title="Delete"></i></a>
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
    {!! $experiences->links() !!}
</div>
