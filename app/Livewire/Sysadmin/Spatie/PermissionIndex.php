<?php

namespace App\Livewire\Sysadmin\Spatie;

use App\Constants\Permissions;
use Illuminate\Auth\Access\AuthorizationException;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Spatie\Permission\Models\Permission;

 
// #[Layout('sysadmin.permissions')]
class PermissionIndex extends Component
{
    public string $header_title = 'Permissions';
    public string $subtitle = 'Index';

    public $permissions = [];

    protected $listeners = [
        'refreshPermissions' => 'loadPermissions'
    ];

    public function mount()
    {
        
        $this->loadPermissions();
    }

    public function loadPermissions()
    {
        $this->permissions = Permission::all();
    }

    public function create()
    {
        try {

            $this->authorize(Permissions::CREATE_PERMISSIONS);

        } catch (AuthorizationException $e) {
            //This action can be customized as required.
            abort(403, 'You do not have permission to create permissions.');
        }


        $this->dispatch('openModal', ['mode' => 'create']);
    }

    public function edit($id)
    {
        try {

            $this->authorize(Permissions::EDIT_PERMISSIONS);

        } catch (AuthorizationException $e) {
            //This action can be customized as required.
            abort(403, 'You do not have permission to edit permissions.');
        }


        $this->dispatch('openModal', ['mode' => 'edit', 'id' => $id]);
    }

    public function delete($id)
    {
        try {

            $this->authorize(Permissions::DELETE_PERMISSIONS);

        } catch (AuthorizationException $e) {
            //This action can be customized as required.
            abort(403, 'You do not have permission to delete permissions.');
        }


        Permission::find($id)?->delete();
        $this->loadPermissions();
    }

    public function render()
    {

        try {

            $this->authorize(Permissions::VIEW_PERMISSIONS);

        } catch (AuthorizationException $e) {
            //This action can be customized as required.
            abort(403, 'You do not have permission to view permissions.');
        }


        
        return view('livewire.sysadmin.spatie.permission-index');
    }
}
