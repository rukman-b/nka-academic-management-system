<?php

namespace App\Livewire\Sysadmin\Spatie;

use Livewire\Component;
use App\Models\User;
use Livewire\Attributes\Layout;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


// #[Layout('sysadmin.permissions')]
class UserPermissionsForm extends Component
{


    public $userId;
    public $user;

    public $roles = [];
    public $permissions = [];

    public $selectedRoles = [];
    public $selectedPermissions = [];

    public function mount(User $user)
    {
        $this->user = $user;
        $this->userId = $user->id;

        $this->roles = Role::all();
        $this->permissions = Permission::all();

        $this->selectedRoles = $this->user->roles->pluck('id')->toArray();
        $this->selectedPermissions = $this->user->permissions->pluck('id')->toArray();
    }
    // public function save()
    // {
    //     dd($this->selectedRoles);
    //     // Sync roles (IDs are fine here)
    //     $this->user->syncRoles($this->selectedRoles);
    //     // dd("I am here 103");
    
    //     // Sync permissions (convert IDs to models)
    //     $permissions = Permission::whereIn('id', $this->selectedPermissions)->get();
    
    //     $this->user->syncPermissions($permissions);
    
    //     session()->flash('message', 'Roles and permissions updated successfully!');
    // }


    public function save()
    {
        // Convert role IDs to role models
        $roles = Role::whereIn('id', $this->selectedRoles)->get();
        
        // Sync roles (now using models)
        $this->user->syncRoles($roles);
        
        // Sync permissions (already correct)
        $permissions = Permission::whereIn('id', $this->selectedPermissions)->get();
        $this->user->syncPermissions($permissions);
        
        session()->flash('message', 'Roles and permissions updated successfully!');
    }
    

    public function render()
    {
        return view('livewire.sysadmin.spatie.user-permissions-form');
    }
}
