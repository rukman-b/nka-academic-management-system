<?php

// app/Livewire/Admin/ExitAwardManager.php

namespace App\Livewire\Admin\Exitawards;

use App\Models\ExitAward;
use App\Models\Level;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ExitAwardManager extends Component
{
    public $exit_award_id;
    public $title;
    public $short_code;
    public $level_id;
    public $min_credits;
    public $description;

    public $editing = false;

    public function rules()
    {
        return [
            'title'       => 'required|string|max:255|unique:exit_awards,title,' . $this->exit_award_id,
            'short_code'  => 'required|string|max:50|unique:exit_awards,short_code,' . $this->exit_award_id,
            'level_id'  => 'required|exists:levels,id',
            'min_credits' => 'required|integer|min:0|max:600',
            'description' => 'nullable|string|max:1000',
        ];
    }

    public function save()
    {
        $this->validate();

        ExitAward::updateOrCreate(
            ['id' => $this->exit_award_id],
            $this->only(['title', 'short_code', 'level_id', 'min_credits', 'description'])
        );

        session()->flash('success', $this->editing ? 'Exit Award updated.' : 'Exit Award created.');

        $this->resetForm();
    }

    public function edit(ExitAward $exitAward)
    {
        $this->exit_award_id = $exitAward->id;
        $this->title         = $exitAward->title;
        $this->short_code    = $exitAward->short_code;
        $this->level_id      = $exitAward->level_id;
        $this->min_credits   = $exitAward->min_credits;
        $this->description   = $exitAward->description;
        $this->editing       = true;
        // dd($this->level_id);
    }

    public function delete(ExitAward $exitAward)
    {
        $exitAward->delete();
        session()->flash('success', 'Exit Award deleted.');
    }

    public function resetForm()
    {
        $this->reset(['exit_award_id', 'title', 'short_code', 'level_id', 'min_credits', 'description', 'editing']);
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.admin.exitawards.exit-award-manager', [
            // 'exitAwards' => ExitAward::orderBy('level_id')->get(), //Do not remove
            // 'levels' => Level::all(), // Do not remove

            'exitAwards' => ExitAward::cachedOrdered(),
            'levels' => Level::cachedList(),
        ]);
    }
}
