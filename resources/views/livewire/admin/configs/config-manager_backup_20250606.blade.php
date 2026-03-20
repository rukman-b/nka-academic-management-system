{{-- This version has duration, delivery_type, experienc_type included. But has been removed for the time being as they are external to my project expectation.
 --}}
<div>
    <div class="card card-primary">
        <x-flash-message /> {{-- Flash message --}}

        <div class="card-header">
            <h3 class="card-title">{{ $editing ? 'Edit Configuration' : 'Add New Configuration' }}</h3>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="save">
                <div class="row">
                    {{-- Programme --}}
                    <div class="form-group col-md-6">
                        <label for="programme_id">Programme</label>
                        <select wire:model.live="programme_id" id="programme_id" class="form-control @error('programme_id') is-invalid @enderror">
                            <option value="">Select Programme</option>
                            @foreach($programmes as $programme)
                                <option value="{{ $programme->id }}">{{ $programme->name }}</option>
                            @endforeach
                        </select>
                        @error('programme_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    {{-- Delivery Type --}}
                    <div class="form-group col-md-6">
                        <label for="delivery_type_id">Delivery Type</label>
                        <select wire:model.live="delivery_type_id" id="delivery_type_id" class="form-control @error('delivery_type_id') is-invalid @enderror">
                            <option value="">Select Delivery Type</option>
                            @foreach($deliveryTypes as $delivery)
                                <option value="{{ $delivery->id }}">{{ $delivery->label }} ({{ $delivery->code }})</option>
                            @endforeach
                        </select>
                        @error('delivery_type_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    {{-- Experience Type --}}
                    <div class="form-group col-md-6">
                        <label for="experience_type_id">Experience Type</label>
                        <select wire:model.live="experience_type_id" id="experience_type_id" class="form-control @error('experience_type_id') is-invalid @enderror">
                            <option value="">Select Experience Type</option>
                            @foreach($experienceTypes as $experience)
                                <option value="{{ $experience->id }}">{{ $experience->label }} ({{ $experience->code }})</option>
                            @endforeach
                        </select>
                        @error('experience_type_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    {{-- Configuration Code + Regenerate --}}
                    <div class="form-group col-md-6">
                        <label for="name">Configuration Code</label>
                        <div class="input-group">
                            <input type="text" wire:model.live="name" id="name" class="form-control @error('name') is-invalid @enderror">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" wire:click="generateName">Regenerate</button>
                            </div>
                        </div>
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    {{-- Duration --}}
                    <div class="form-group col-md-6">
                        <label for="duration">Programme Duration</label>
                        <input type="text" wire:model.live="duration" id="duration" class="form-control @error('duration') is-invalid @enderror">
                        @error('duration') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    {{-- Delivery Method --}}
                    <div class="form-group col-md-6">
                        <label for="delivery_method">Delivery Method</label>
                        <select wire:model.live="delivery_method" id="delivery_method" class="form-control @error('delivery_method') is-invalid @enderror">
                            <option value="">Select Method</option>
                            <option value="Online">Online</option>
                            <option value="NKA premises">NKA premises</option>
                            <option value="Hybrid">Hybrid</option>
                        </select>
                        @error('delivery_method') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    {{-- Language --}}
                    <div class="form-group col-md-6">
                        <label for="language">Language</label>
                        <select wire:model.live="language" id="language" class="form-control @error('language') is-invalid @enderror">
                            <option value="">Select Language</option>
                            <option value="English">English</option>
                            <option value="Sinhala">Sinhala</option>
                            <option value="Tamil">Tamil</option>
                        </select>
                        @error('language') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    {{-- Pass Marks --}}
                    <div class="form-group col-md-6">
                        <label for="pass_marks">Pass Marks</label>
                        <input type="number" wire:model.live="pass_marks" id="pass_marks" class="form-control @error('pass_marks') is-invalid @enderror">
                        @error('pass_marks') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    {{-- Description --}}
                    <div class="form-group col-12">
                        <label for="description">Description</label>
                        <textarea wire:model.live="description" id="description" class="form-control @error('description') is-invalid @enderror"></textarea>
                        @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>

                {{-- Active Checkbox --}}
                <div class="form-check mb-3">
                    <input type="checkbox" wire:model.live="status" id="status" class="form-check-input">
                    <label for="status" class="form-check-label">Active</label>
                </div>

                {{-- Action Buttons --}}
                <x-action-button-group :buttons="[
                    ...($editing ? [['method' => 'cancelEdit', 'buttonType' => 'cancel']] : []),
                    [
                        'method'      =>'save',
                        'buttonType'  => $editing ? 'Update' : 'Create',
                        'confirm'     => $editing,
                    ],
                ]" />

            </form>
        </div>
    </div>

    {{-- Config DataTable --}}
    @include('livewire.admin.configs.partials.config-list')

        
    <!-- Config Details Modal -->
    <x-modal id="configDetailsModal" title="Configuration Details">
        <dl class="row mb-0">
            

            <dt class="col-sm-4 font-weight-bold">Delivery Method</dt>
            <dd class="col-sm-8">{{ $selectedConfig->delivery_method ?? '—' }}</dd>

            <dt class="col-sm-4 font-weight-bold">Language</dt>
            <dd class="col-sm-8">{{ $selectedConfig->language ?? '—' }}</dd>

            <dt class="col-sm-4 font-weight-bold">Description</dt>
            <dd class="col-sm-8">{{ $selectedConfig->description ?? '—' }}</dd>


        </dl>
    </x-modal>
</div>


@push('scripts')
<script>
    window.addEventListener('show-config-modal', () => {
        $('#configDetailsModal').modal('show');
    });
</script>
@endpush