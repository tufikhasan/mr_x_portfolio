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
                        <a href="#editSkill" class="edit" data-toggle="modal" data-id="{{ $skill->id }}"
                            data-name="{{ $skill->name }}"><i class="fas fa-edit" data-toggle="tooltip"
                                title="Edit"></i></a>
                        <a href="#deleteSkill" class="delete" data-toggle="modal" data-id="{{ $skill->id }}"><i
                                class="fas fa-trash-alt" data-toggle="tooltip" title="Delete"></i></a>
                    @else
                        <a class="role_alert"><i class="fas fa-edit" data-toggle="tooltip" title="Edit"></i></a>
                        <a class="role_alert"><i class="fas fa-trash-alt" data-toggle="tooltip" title="Delete"></i></a>
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
