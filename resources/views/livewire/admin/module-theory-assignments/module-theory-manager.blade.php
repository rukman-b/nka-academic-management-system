@php use Illuminate\Support\Str; @endphp

<div>
    {{-- Top Card: Assign Theory to Module --}}
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Assign Theory to Module</h3>
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

                    {{-- Theory Selection --}}
                    <div class="form-group col-md-4">
                        <label for="theory_id">Theory</label>
                        <select id="theory_id" wire:model.live="theory_id" class="form-control @error('theory_id') is-invalid @enderror">
                            <option value="">-- Select Theory --</option>
                            @foreach($filteredTheories as $theory)
                                <option value="{{ $theory->id }}">{{ $theory->title }}</option>
                            @endforeach
                        </select>
                        @error('theory_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
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
                    <div class="form-group col-md-12">
                        <label for="teaching_notes">Teaching Notes</label>
                        <input type="text" id="teaching_notes" wire:model.defer="teaching_notes" class="form-control">
                    </div>
                </div>

                <div class="mt-3 text-right">
                    <button type="submit" class="btn btn-success">Assign</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card card-dark mt-3">
        <div class="card-header">
            <h3 class="card-title">Current Theory Assignments</h3>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover table-striped table-sm">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Module</th>
                        <th>Teaching Notes</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($assignments as $index => $assignment)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $assignment->module->name ?? '—' }}</td>
                            <td>{{ $assignment->teaching_notes ?? '—' }}</td>
                            <td class="text-center">
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
                            <td colspan="4" class="text-center">No theory assignments found for selected department.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- ModuleTheory Table --}}
    @include('livewire.admin.module-theory-assignments.partials.module-theory-assigner-list')


    <!-- ModulePractical Details Modal -->
    <x-modal id="detailModal" title="Module Practical Assignments Details">
        <dl class="row mb-0">
            

            <dt class="col-sm-4 font-weight-bold">Teaching Notes</dt>
            <dd class="col-sm-8">{{ $item->teaching_notes ?? '—' }}</dd>


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

