<div>
    {{-- Top Card: Assign Skills to Module --}}
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Assign Skills to Module</h3>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="assign">
                <div class="row">
                    {{-- Department Selection --}}
                    <div class="form-group col-md-4">
                        <label for="department_id">Department</label>
                        <select id="department_id" wire:model.live="department_id" class="form-control @error('department_id') is-invalid @enderror">
                            <option value="">-- Select Department --</option>
                            @foreach($departments as $dept)
                                <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                            @endforeach
                        </select>
                        @error('department_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Module Selection --}}
                    <div class="form-group col-md-4">
                        <label for="module_id">Module</label>
                        <select id="module_id" wire:model.live="module_id" class="form-control @error('module_id') is-invalid @enderror">
                            <option value="">-- Select Module --</option>
                            @foreach($filteredModules as $module)
                                <option value="{{ $module->id }}">{{ $module->name }}</option>
                            @endforeach
                        </select>
                        @error('module_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- @if(!empty($availableSkills)) --}}
                    <div class="form-group">
                        <label class="mb-2 font-weight-bold">Available Skills <span class="text-muted">(Select to Assign)</span></label>

                        <div style="height: 200px; overflow-y: auto; overflow-x: hidden; border: 1px solid #ced4da; border-radius: 4px; padding: 0.75rem;">
                            <div class="row">
                                @foreach($availableSkills as $skill)
                                    <div class="col-md-4 col-sm-6 mb-2">
                                        <div class="form-check">
                                            <input wire:model="selectedSkillIds"
                                                   class="form-check-input"
                                                   type="checkbox"
                                                   id="skill_{{ $skill->id }}"
                                                   value="{{ $skill->id }}">
                                            <label class="form-check-label" for="skill_{{ $skill->id }}">
                                                {{ $skill->name }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        @error('selectedSkillIds') <div class="text-danger mt-2">{{ $message }}</div> @enderror
                    </div>
                {{-- @endif --}}



                <div class="text-right">
                    <button type="submit" class="btn btn-success">Assign Selected Skills</button>
                </div>
            </form>
        </div>
    </div>

    

     {{-- ModuleSkills Table --}}
    @include('livewire.admin.module-skill-assignments.partials.module-skill-assignments-list')

    

</div>
