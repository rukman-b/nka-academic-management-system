

@php
    use App\Constants\Permissions;
@endphp


{{-- @section('content_header_title', $header_title)
@section('content_header_subtitle', $subtitle) --}}
    <div class="card card-primary">
        {{-- <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">Role Management</h3>
            <button class="btn btn-sm btn-light" wire:click="dispatch('createRole')">
                <i class="fas fa-plus"></i> Create Role
            </button>
        </div> --}}

        <div class="card-header">
            <h3 class="card-title">Role Management</h3>
            <div class="card-tools">
                @can(Permissions::CREATE_ROLES)
                    <button class="btn btn-success btn-sm" wire:click="dispatch('createRole')">
                        <i class="fas fa-plus"></i> Create Role
                    </button>
                @endcan
            </div>
        </div>

        <div class="card-body">
            @if(session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Guard</th>
                        <th>Permissions</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($roles as $role)
                    <tr>
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->guard_name }}</td>
                        <td>
                            @foreach($role->permissions as $perm)
                                <span class="badge badge-info">{{ $perm->name }}</span>
                            @endforeach
                        </td>
                        <td>
                            <div style="display: flex; gap: 5px;">
                                @can(Permissions::EDIT_ROLES)
                                    <button wire:click="dispatch('editRole', [{{ $role->id }}])" class="btn btn-sm btn-warning">
                                        Edit
                                    </button>
                                @endcan

                                @can(Permissions::DELETE_ROLES)
                                    <button 
                                            x-data
                                            @click.prevent="if (confirm('Are you sure?')) { $wire.deleteRole({{ $role->id }}) }"
                                            class="btn btn-sm btn-danger"
                                        >
                                            Delete
                                        </button>
                                @endcan
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @livewire('sysadmin.spatie.role-form')
    </div>
