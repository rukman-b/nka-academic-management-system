@php use Illuminate\Support\Str; @endphp

<div>
    {{-- Top Card: Assign Practical to Module --}}
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Assign Practical to Module</h3>
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

                    {{-- Practical Selection --}}
                    <div class="form-group col-md-4">
                        <label for="practical_id">Practical</label>
                        <select id="practical_id" wire:model.live="practical_id" class="form-control @error('practical_id') is-invalid @enderror">
                            <option value="">-- Select Practical --</option>
                            @foreach($filteredPracticals as $practical)
                                <option value="{{ $practical->id }}">{{ $practical->title }}</option>
                            @endforeach
                        </select>
                        @error('practical_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    {{-- Module Selection --}}
                    <div class="form-group col-md-4">
                        <label for="module_id">Available Modules</label>
                        <select id="module_id" wire:model.defer="module_id" class="form-control @error('module_id') is-invalid @enderror">
                            <option value="">-- Select Module --</option>
                            @foreach($filteredModules as $module)
                                <option value="{{ $module->id }}">{{ $module->name }}</option>
                            @endforeach
                        </select>
                        @error('module_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="lab_room">Lab Room</label>
                        <input type="text" id="lab_room" wire:model.defer="lab_room" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="instructor_notes">Instructor Notes</label>
                        <input type="text" id="instructor_notes" wire:model.defer="instructor_notes" class="form-control">
                    </div>
                </div>

                <div class="mt-3 text-right">
                     {{-- Action Buttons --}}
                <x-action-button-group :buttons="[
                    [
                        'method'      => 'assign',
                        'buttonType'  => 'Create',
                        'label'     => 'Assign',
                    ],
                ]" />
                </div>
            </form>
        </div>
    </div>

     {{-- Bottom Card: Current Assignments --}}
    <div class="card card-dark mt-3">
    <div class="card-header">
        <h3 class="card-title">Current Assignments</h3>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-bordered table-hover table-striped table-sm">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Module</th>
                    <th>Lab Room</th>
                    <th style="text-align: center;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($assignments as $index => $assignment)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $assignment->module->name ?? '—' }}</td>
                        <td>{{ $assignment->lab_room ?? '—' }}</td>
                        <td>
                            @php
                                $buttons = [
                                    [
                                        'method'=> 'delete',
                                        'params' => [$assignment->id],
                                        'buttonType' => 'delete',
                                    ],
                                    [
                                        'method'=> 'loadDetailsModal',
                                        'params' => [$assignment->id],
                                        'buttonType' => 'view',
                                    ]
                                ];
                            @endphp
                            <x-action-button-group :buttons="$buttons" />

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No assignments found for selected practical.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>



    {{-- ModulePractical Table --}}
    @include('livewire.admin.practical-module-assignments.partials.practical-module-assigner-list')



    <!-- ModulePractical Details Modal -->
    <x-modal id="detailModal" title="Module Practical Assignments Details">
        <dl class="row mb-0">
            

            <dt class="col-sm-4 font-weight-bold">Instructor Note</dt>
            <dd class="col-sm-8">{{ $item->instructor_notes ?? '—' }}</dd>


        </dl>
    </x-modal>
</div>


@push('scripts')
<script>
    window.addEventListener('show-details-modal', () => {
        $('#detailModal').modal('show');
    });
</script>
@endpush
