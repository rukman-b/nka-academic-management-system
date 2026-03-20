<div>
    <div class="card card-primary">
        <x-flash-message /> {{-- Flash message --}}

        <div class="card-header">
            <h3 class="card-title">{{ $editing ? 'Edit Module' : 'Add New Module' }}</h3>
        </div>
        
        <div class="card-body">
            {{-- Departments --}}
             <div class="form-group">
                    <label for="departments">Departments</label>

                    <div style="max-height: 150px; overflow-y: auto; border: 1px solid #ced4da; border-radius: .25rem; padding: .5rem;">
                        @foreach($departments as $dept)
                            <div class="form-check">
                                <input
                                    type="checkbox"
                                    class="form-check-input"
                                    id="dept_{{ $dept->id }}"
                                    value="{{ $dept->id }}"
                                    wire:model.live="department_ids"
                                >
                                <label class="form-check-label" for="dept_{{ $dept->id }}">
                                    {{ $dept->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>

                    @error('department_ids')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            <form wire:submit.prevent="{{ $editing ? 'update' : 'create' }}">
                <div class="form-group">
                    <label for="module_code">Module Code (ABCD12345 - 4 uppercase letters + 5 digits)</label>
                    <input type="text" wire:model.live="module_code" id="module_code" class="form-control @error('module_code') is-invalid @enderror">
                    @error('module_code') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="name">Module Name</label>
                    <input type="text" wire:model.live="name" id="name" class="form-control @error('name') is-invalid @enderror">
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="mark">Module Marks</label>
                    <input type="text" wire:model.defer="mark" id="mark" class="form-control @error('mark') is-invalid @enderror">
                    @error('mark') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="fheq_level_id">FHEQ  Level (Optional)</label>
                    <select wire:model.live="fheq_level_id" id="fheq_level_id" class="form-control">
                        <option value="">-- Select Level --</option>
                        @foreach($levels as $level)
                            <option value="{{ $level->id }}">{{ $level->name }}</option>
                        @endforeach
                    </select>
                    @error('fheq_level_id') <span class="text-danger">{{ $message }}</span> @enderror

                </div>
                <div class="form-group">
                    <label for="lecturer_id">Lecturer </label>
                    <select wire:model.live="lecturer_id" id="lecturer_id" class="form-control">
                        <option value="">-- Select Level --</option>
                        @foreach($lecturers as $lecturer)
                            <option value="{{ $lecturer->id }}" @selected($lecturer_id == $lecturer->id)>{{ $lecturer->name }}</option>                        
                        @endforeach
                    </select>
                    @error('lecturer_id') <span class="text-danger">{{ $message }}</span> @enderror

                </div>

                

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea wire:model.live="description" id="description" class="form-control"></textarea>
                </div>

                {{-- <div class="form-group">
                    <label for="departments">Departments</label>
                    <select wire:model.live="department_ids" multiple class="form-control">
                        @foreach($departments as $dept)
                            <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                        @endforeach
                    </select>
                    @error('department_ids') <span class="text-danger">{{ $message }}</span> @enderror
                </div> --}}
               

                {{-- Action Buttons --}}
                <x-action-button-group :buttons="[
                    ...($editing ? [['method' => 'resetForm', 'buttonType' => 'cancel']] : []),
                    [
                        'method'      => $editing ? 'update' : 'create',
                        'buttonType'  => $editing ? 'Update' : 'Create',
                        'confirm'     => $editing,
                    ],
                    
                ]" />

                {{-- <button class="btn btn-success" type="submit">{{ $editing ? 'Update' : 'Create' }}</button>
                @if($editing)
                    <button type="button" wire:click="resetForm" class="btn btn-secondary">Cancel</button>
                @endif --}}
            </form>
        </div>
    </div>

     {{-- Moudles Table --}}
    @include('livewire.admin.modules.partials.modules-list')


</div>
