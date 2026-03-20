<div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <!-- Top Card: Assign Module to Semester -->
            <div class="card card-primary">
                <x-flash-message /> {{-- Flash message --}}
                <div class="card-header"><h3 class="card-title">Assign Module to Semester</h3></div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Department</label>
                        <select wire:model.live="departmentId" class="form-control">
                            <option value="">-- select --</option>
                            @foreach($departments as $dept)
                                <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                            @endforeach
                        </select>
                          @error('departmentId') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                   

                    <div class="form-group">
                        <label>Semester</label>
                        <select wire:model.live="semesterId" class="form-control">
                            <option value="">-- select --</option>
                            @foreach($semesters as $sem)
                                <option value="{{ $sem->id }}">{{ $sem->name }} ({{ $sem->academic_year }})</option>
                            @endforeach
                        </select>
                        @error('semesterId') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>


                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" wire:model="assignResit" id="assignResit">
                        <label class="form-check-label" for="assignResit">Also assign resit in Semester 3</label>
                    </div>


                     <div class="form-group">
                        <label>Module</label>
                        <select wire:model.lazy="moduleId" class="form-control">
                            <option value="">-- select --</option>
                            @foreach($filteredModules as $mod)
                                <option value="{{ $mod->id }}">{{ $mod->name }}</option>
                            @endforeach
                        </select>
                        @error('moduleId') <span class="text-danger">{{ $message }}</span> @enderror

                    </div>

                    <button wire:click="assign" class="btn btn-primary">Assign</button>
                </div>
            </div>

            <!-- Bottom Card: List Assigned Modules -->
            {{-- <div class="card card-secondary">
                <div class="card-header"><h3 class="card-title">Assigned Modules</h3></div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Module</th>
                                <th>Semester</th>
                                <th>Academic Year</th>
                                <th>Type</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($assigned as $a)
                                <tr>
                                    <td>{{ $a->module->name }}</td>
                                    <td>{{ $a->semester->name }}</td>
                                    <td>{{ $a->semester->academic_year }}</td>
                                    <td>{{ ucfirst($a->offering_type) }}</td>
                                    <td>
                                        <button wire:click="remove({{ $a->id }})"
                                                class="btn btn-danger btn-sm">Remove</button>
                                    </td>
                                </tr>
                            @endforeach
                            @if($assigned->isEmpty())
                                <tr><td colspan="5" class="text-center">No assignments found.</td></tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> --}}
    {{-- Bottom Card: Batch List --}}
    @include('livewire.admin.module-semester-assignments.partials.module-semester-assigner-list')

</div>
