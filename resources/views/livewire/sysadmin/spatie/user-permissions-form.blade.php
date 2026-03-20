
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Manage Roles & Permissions for {{ $user->name }}</h3>
    </div>

    <div class="card-body">
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <!-- Roles -->
        <div class="form-group">
            <label>Roles</label>
            <div class="row">
                @foreach($roles as $role)
                    <div class="col-md-4">
                        <div class="form-check">
                            <input type="checkbox"
                                   class="form-check-input"
                                   id="role-{{ $role->id }}"
                                   value="{{ $role->id }}"
                                   wire:model="selectedRoles">
                            <label class="form-check-label" for="role-{{ $role->id }}">
                                {{ $role->name }}
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Permissions -->
        <div class="form-group">
            <label>Direct Permissions</label>
            <div class="row">
                @foreach($permissions as $permission)
                    <div class="col-md-4">
                        <div class="form-check">
                            <input type="checkbox"
                                   class="form-check-input"
                                   id="perm-{{ $permission->id }}"
                                   value="{{ $permission->id }}"
                                   wire:model="selectedPermissions">
                            <label class="form-check-label" for="perm-{{ $permission->id }}">
                                {{ $permission->name }}
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="card-footer">
        <button wire:click="save" class="btn btn-primary">Save</button>
        <a href="{{ route('sysadmin.users') }}" class="btn btn-secondary">Back</a>
    </div>
</div>
