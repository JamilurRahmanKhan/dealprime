@extends('admin.layouts.master')

@section('title')Role Edit @endsection

@section('body')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('role.index') }}">Role Manage</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Role Edit</li>
                    </ol>
                </nav>
            </div>
            <h2 class="page-title">Role Module</h2>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Edit Role Form</h4>
                <p class="text-muted font-14">{{ Session::get('message') }}</p>

                <form class="form-horizontal" action="{{ route('role.update', $role->id) }}" method="POST">
                    @method('put')
                    @csrf
                    <div class="row mb-3">
                        <label for="roleName" class="col-3 col-form-label">Role Name</label>
                        <div class="col-9">
                            <input type="text" value="{{ $role->name }}" class="form-control @error('name') is-invalid @enderror" name="name" id="roleName" placeholder="Role Name" />
                            @error('name')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="roleDescription" class="col-3 col-form-label">Description</label>
                        <div class="col-9">
                            <textarea class="form-control @error('description') is-invalid @enderror" id="roleDescription" name="description" placeholder="Role Description">{!! $role->description !!}</textarea>
                            @error('description')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <span id="allSelect" class="mb-2" style="cursor:pointer;">All Select</span>
                    <div class="text-danger text-center">@error('permissions'){{ $message }}@enderror</div>
                    <hr class="mt-1 mb-0">

                    <!-- Display grouped permissions dynamically -->
                    @foreach ($permissions as $group => $groupPermissions)
                    <div class="row py-2">
                        <span class="col-md-3 col-form-label group-select" style="cursor:pointer;" data-group="{{ $group }}">{{ ucfirst($group) }}</span>
                        <div class="col-md-9">
                            @foreach ($groupPermissions as $permission)
                            <input type="checkbox" class="mt-2 permission-checkbox" name="permissions[]" value="{{ $permission->id }}" @if($role->permissions->contains($permission->id)) checked @endif id="permission-{{ $permission->id }}" data-group="{{ $group }}">
                            <label for="permission-{{ $permission->id }}">{{ $permission->name }}</label> &nbsp;
                            @endforeach
                        </div>
                    </div>
                    <hr class="m-0">
                    @endforeach

                    <div class="justify-content-end row mt-2">
                        <div class="col-9 text-end">
                            <button type="submit" class="btn btn-info">Update Role</button>
                        </div>
                    </div>
                </form>

            </div> <!-- end card-body -->
        </div> <!-- end card -->
    </div> <!-- end col -->
</div>

<script>
    $(document).ready(function() {
    // Handle 'All Select' checkbox
    let allSelected = false;
    $('#allSelect').click(function() {
        allSelected = !allSelected;
        $('.permission-checkbox').prop('checked', allSelected); // Select or deselect all checkboxes
        $(this).text(allSelected ? 'Deselect All' : 'All Select'); // Toggle button text
    });

    // Handle group-wise checkbox selection
    $('.group-select').click(function() {
        let group = $(this).data('group'); // Get the group name
        let groupCheckboxes = $('.permission-checkbox[data-group="' + group + '"]'); // Get the checkboxes for this group

        let groupSelected = groupCheckboxes.filter(':checked').length === 0; // Check if the group is not selected
        groupCheckboxes.prop('checked', groupSelected); // Toggle the selection for the group
    });
});

</script>
@endsection
