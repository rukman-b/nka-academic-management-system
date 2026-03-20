<?php

namespace App\Livewire\Sysadmin\Spatie;

use App\Constants\Permissions;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

// #[Layout('sysadmin.users')]
class UserIndex extends Component
{
    use WithPagination;

    public string $header_title = 'Users';
    public string $subtitle = 'Index';


    protected $paginationTheme = 'bootstrap'; // AdminLTE + Bootstrap theme

    public function delete($id)
    {
        try {

            $this->authorize(Permissions::DELETE_USERS);

        } catch (AuthorizationException $e) {
            //This action can be customized as required.
            abort(403, 'You do not have permission to delete users.');
        }


        User::where('id', $id)->delete();
        session()->flash('message', 'User deleted successfully!');
        $this->resetPage();
    }

    public function render()
    {
        try {

            $this->authorize(Permissions::VIEW_USERS);

        } catch (AuthorizationException $e) {
            //This action can be customized as required.
            abort(403, 'You do not have permission to view users.');
        }


        
        // Eager load roles and permissions for each user
        $users = User::with(['roles', 'permissions'])->paginate(5); // Fetch users with roles and permissions

        return view('livewire.sysadmin.spatie.user-index', [
            'users' => $users,
            'header_sub'=>'Users',
        ]);
    }
}
