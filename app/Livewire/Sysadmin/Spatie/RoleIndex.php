<?php

namespace App\Livewire\Sysadmin\Spatie;

use App\Constants\Permissions;
use Illuminate\Auth\Access\AuthorizationException;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class RoleIndex extends Component
{
    public $roles;

    protected $listeners = ['roleUpdated' => 'loadRoles'];

    public function mount()
    {
        $this->loadRoles();
    }

    public function loadRoles()
    {
        $this->roles = Role::all();
    }

    public function deleteRole($roleId)
    {
        try {

            $this->authorize(Permissions::DELETE_ROLES);

        } catch (AuthorizationException $e) {
            //This action can be customized as required.
            abort(403, 'You do not have permission to delete roles.');
        }

        $role = Role::find($roleId);

        if (!$role) {
            session()->flash('error', 'Role not found.');
            return;
        }


        $role->delete();

        session()->flash('message', 'Role deleted successfully.');

        $this->loadRoles();
    }

    public function render()
    {
        try {

            $this->authorize(Permissions::VIEW_ROLES);

        } catch (AuthorizationException $e) {
            //This action can be customized as required.
            abort(403, 'You do not have permission to view roles.');
        }

        return view('livewire.sysadmin.spatie.role-index');
    }
}
