<?php

namespace App\Livewire\Admin\Levels;

use App\Models\Level;
use Illuminate\Database\QueryException;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Illuminate\Support\Facades\Cache; 


//traits
use App\Livewire\Traits\HandlesDeleteExceptions;



class LevelManager extends Component
{

    use HandlesDeleteExceptions;

    // Reactive update trigger
    public $refreshKey = 0;

    public ?Level $editing = null;
    public string $fheq_level = '';
    public string $name = '';
    public string $description = '';

    public function mount(): void
    {
        $this->resetForm();
    }

    public function create(): void
    {
        // $this->authorize('create', Level::class);
        $this->validateForm();

        Level::create([
            'fheq_level' => $this->fheq_level,
            'name' => $this->name,
            'description' => $this->description,
        ]);

        session()->flash('success', 'Level created successfully.');
        $this->resetForm();
        $this->refreshKey++;
    }

    public function edit(Level $level): void
    {
        // $this->authorize('update', $level);

        $this->editing = $level;
        $this->fheq_level = $level->fheq_level;
        $this->name = $level->name;
        $this->description = $level->description ?? '';
    }

    public function update(): void
    {
        // $this->authorize('update', $this->editing);
        $this->validateForm();

        $this->editing->update([
            'fheq_level' => $this->fheq_level,
            'name' => $this->name,
            'description' => $this->description,
        ]);

        session()->flash('success', 'Level updated successfully.');
        $this->resetForm();
        $this->refreshKey++;

    }

    public function delete(Level $level): void
    {
        // $this->authorize('delete', $level);
        
            $this->safeDelete(
            fn() => $level->delete(),
            'Level deleted successfully.',
            'Cannot delete this level because it is referenced by other records.'
        );
        $this->refreshKey++;
        $this->resetForm();


    }

    public function resetForm(): void
    {
        $this->editing = null;
        $this->fheq_level = '';
        $this->name = '';
        $this->description = '';
    }

    public function validateForm(): void
    {
        $this->validate([
            'fheq_level' => ['required', 'integer', 'min:1', Rule::unique('levels', 'fheq_level')->ignore(optional($this->editing)->id)],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ]);
    }

    public function render()
    {
        return view('livewire.admin.levels.level-manager', [
               Level::orderBy('fheq_level')->get()
          
        ]);
    }
}
