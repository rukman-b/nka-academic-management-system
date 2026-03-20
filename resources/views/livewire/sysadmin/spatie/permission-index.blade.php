
@php
    use App\Constants\Permissions;
@endphp


@section('content_header_title', $header_title)
@section('content_header_subtitle', $subtitle)

<div class="card card-primary ">
        <div class="card-header">
            <h3 class="card-title">Permissions</h3>
            <div class="card-tools">
                @can(Permissions::CREATE_PERMISSIONS)
                    <button wire:click="create" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> Add Permission</button>
                @endcan
            </div>
        </div>

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Guard</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($permissions as $permission)
                <tr>
                    <td>{{ $permission->id }}</td>
                    <td>{{ $permission->name }}</td>
                    <td>{{ $permission->guard_name }}</td>
                    <td>
                        @can(Permissions::EDIT_PERMISSIONS)
                            <button wire:click="edit({{ $permission->id }})" class="btn btn-sm btn-warning">Edit</button>
                        @endcan

                        @can(Permissions::DELETE_PERMISSIONS)
                            <button 
                                    x-data
                                    @click.prevent="if (confirm('Are you sure?')) { $wire.delete({{ $permission->id }}) }"
                                    class="btn btn-sm btn-danger"
                                >
                                    Delete
                                </button>
                            
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @livewire('sysadmin.spatie.permission-form')
</div>
