<?php
namespace App\Livewire\Sysadmin\Spatie;

use App\Constants\Guards;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Spatie\Permission\Models\Permission;


// #[Layout('syssysadmin.permissions')]
class PermissionForm extends Component
{

    public $permissionId;
    public $name;
    public $guard_name = Guards::WEB; // default guard
    public $mode = 'create';

    protected $rules = [
        'name' => 'required|string|max:255',
        'guard_name' => 'required|string|max:255',
    ];

    protected $listeners = ['openModal' => 'showModal'];

    public function showModal($params)
    {
        $this->resetValidation();
        $this->reset();

        $this->mode = $params['mode'];

        if ($this->mode === 'edit' && !empty($params['id'])) {
            $permission = Permission::findOrFail($params['id']);
            $this->permissionId = $permission->id;
            $this->name = $permission->name;
            $this->guard_name = $permission->guard_name;
        }

        $this->dispatch('showModal', 'permissionModal');
    }

    public function closeModal()
    {
        $this->dispatch('hideModal', 'permissionModal');
    }

    public function save()
    {
        $this->validate();

        Permission::updateOrCreate(
            ['id' => $this->permissionId],
            [
                'name' => $this->name,
                'guard_name' => $this->guard_name,
            ]
        );

        $this->dispatch('hideModal', 'permissionModal');
        $this->dispatch('refreshPermissions');
    }

    public function render()
    {
        return view('livewire.sysadmin.spatie.permission-form');
    }
}
