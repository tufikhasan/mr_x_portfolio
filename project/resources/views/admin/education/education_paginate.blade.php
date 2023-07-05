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
                        <a href="#editEducation" class="edit" data-toggle="modal" data-id="{{ $education->id }}"
                            data-duration="{{ $education->duration }}"
                            data-institute_name="{{ $education->institute_name }}" data-field="{{ $education->field }}"
                            data-details="{{ $education->details }}"><i class="fas fa-edit" data-toggle="tooltip"
                                title="Edit"></i></a>
                        <a href="#deleteEducation" class="delete" data-toggle="modal" data-id="{{ $education->id }}"><i
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
    {!! $educations->links() !!}
</div>
