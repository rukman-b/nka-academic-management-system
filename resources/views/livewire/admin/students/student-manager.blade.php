<div>
    {{-- Top Card: Student Create/Edit Form --}}
       <div class="card card-primary">
            <x-flash-message /> {{-- Flash message --}}
            <div class="card-header">
                <h3 class="card-title">{{ $editingId ? 'Edit Student' : 'Create Student' }}</h3>
            </div>
            <div class="card-body">
                    <form wire:submit.prevent="save">
                        <div class="row">
                            {{-- Full Name --}}
                            <div class="form-group col-md-6">
                                <label for="name">Full Name</label>
                                <input type="text" id="name" wire:model.defer="name"
                                    class="form-control @error('name') is-invalid @enderror" >
                                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            {{-- Email Address --}}
                            <div class="form-group col-md-6">
                                <label for="email">Email Address</label>
                                <input type="email" id="email" wire:model.defer="email"
                                    class="form-control @error('email') is-invalid @enderror" >
                                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        {{-- Address Component --}}
                        @include('components.address-fields', ['modelPrefix' => 'address.'])


                        <div class="row">
                            {{-- Phone Number --}}
                            <div class="form-group col-md-6">
                                <label for="phone">Phone Number</label>
                                <input type="text" id="phone" wire:model.defer="phone"
                                    class="form-control @error('phone') is-invalid @enderror">
                                @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            {{-- Date of Birth --}}
                            <div class="form-group col-md-6">
                                <label for="dob">Date of Birth</label>
                                <input type="date" id="dob" wire:model.defer="dob"
                                    class="form-control @error('dob') is-invalid @enderror">
                                @error('dob') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="row">
                            {{-- Password --}}
                            <div class="form-group col-md-6" x-data="{ show: false }">
                                <label for="password">
                                    {{ $editingId ? 'New Password (Leave blank)' : 'Password' }}
                                </label>
                                <div class="input-group">
                                    <input :type="show ? 'text' : 'password'" id="password"
                                        wire:model.defer="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        {{ $editingId ? '' : '' }}>
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-outline-secondary" @click="show = !show">
                                            <i class="fas" :class="show ? 'fa-eye-slash' : 'fa-eye'"></i>
                                        </button>
                                    </div>
                                </div>
                                @error('password') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                            </div>

                            {{-- Confirm Password --}}
                            <div class="form-group col-md-6" x-data="{ show: false }">
                                <label for="password_confirmation">Confirm Password</label>
                                <div class="input-group">
                                    <input :type="show ? 'text' : 'password'" id="password_confirmation"
                                        wire:model.defer="password_confirmation"
                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                        {{ $editingId ? '' : '' }}>
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-outline-secondary" @click="show = !show">
                                            <i class="fas" :class="show ? 'fa-eye-slash' : 'fa-eye'"></i>
                                        </button>
                                    </div>
                                </div>
                                @error('password_confirmation') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="row">
                            {{-- Programme --}}
                            <div class="form-group col-md-6">
                                <label for="programme_id">Programme</label>
                                <select id="programme_id" wire:model.live="programme_id"
                                    class="form-control @error('programme_id') is-invalid @enderror" >
                                    <option value="">-- Select Programme --</option>
                                    @foreach($programmes as $programme)
                                        <option value="{{ $programme->id }}">{{ $programme->name }}</option>
                                    @endforeach
                                </select>
                                @error('programme_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            {{-- Batch --}}
                            <div class="form-group col-md-6">
                                <label for="batch_id">Batch</label>
                                <select id="batch_id" wire:model.defer="batch_id"
                                    class="form-control @error('batch_id') is-invalid @enderror">
                                    <option value="">-- Select Batch (Optional) --</option>
                                    @foreach($batches as $batch)
                                        <option value="{{ $batch->id }}" @selected($batch->id === $batch_id)>{{ $batch->code }}</option>
                                    @endforeach
                                </select>
                                @error('batch_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        {{-- Buttons --}}
                        <div class="form-group mt-3 text-right">
                            <button type="submit" class="btn btn-success">
                                {{ $editingId ? 'Update' : 'Create' }}
                            </button>
                            <button type="button" wire:click="resetForm" class="btn btn-warning ml-2">
                                Reset
                            </button>
                        </div>
                    </form>
            </div>
        </div>


    {{-- Reusable Livewire DataTable (with scoped scroll restoration) --}}
    <div id="datatable-scroll" class="card card-dark mt-3">
        <div class="card-header">
            <h3 class="card-title">Advanced Table View</h3>
        </div>
        <div class="card-body table-responsive">
            <livewire:components.tables.data-table
                :model="\App\Models\Student::class"
                :columns="['name', 'email','created_at']"
                :column-labels="[
                    'name' => 'Student Name',
                    'email' => 'Email',
                    'created_at'=> 'Created On',
                ]"
                :enableSearch="true"
                :enableSort="true"
                :enableExport="true"
                :perPage="10"
                :showActions="true"
                :actionView="'livewire.admin.students.partials.actions'"
                :key="$refreshKey" {{--Livewire will remount DataTable when key changes --}}
                :export-options="[
                                    'route' => 'admin.export.students',
                                    'label' => 'Export Students',
                                    'filename' => 'students_export',
                                    'tooltip' => 'Download students list as Excel or CSV'
                                ]"
            />

        </div>
    </div>
</div>

 