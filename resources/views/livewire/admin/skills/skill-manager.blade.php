<div>
    <div class="card card-primary">
        <x-flash-message /> {{-- Flash message --}}
        <div class="card-header">
            <h3 class="card-title">{{ $editing ? 'Edit Skill' : 'Add New Skill' }}</h3>
        </div>
        <div class="card-body">
            <form>
                <div class="form-group">
                    <label for="name">Skill Name</label>
                    <input type="text" wire:model.live="name" id="name" class="form-control @error('name') is-invalid @enderror">
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea type="text" wire:model.live="description" id="description" class="form-control @error('description') is-invalid @enderror"></textarea>
                    @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label for="skill_category_id">Skill Category</label>
                    <select wire:model.live="skill_category_id" id="skill_category_id" class="form-control @error('skill_category_id') is-invalid @enderror">
                        <option value="">-- Select Category --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('skill_category_id') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                 {{-- Action Buttons --}}
                <x-action-button-group :buttons="[
                    ...($editing ? [['method' => 'resetForm', 'buttonType' => 'cancel']] : []),
                    [
                        'method'      => $editing ? 'update' : 'create',
                        'buttonType'  => $editing ? 'Update' : 'Create',
                        'confirm'     => $editing,
                    ],
                    
                ]" />

            </form>
        </div>
    </div>

    

    {{-- Skill Table --}}
    @include('livewire.admin.skills.partials.skills-list')


    <!-- Skills Details Modal -->
    <x-modal id="extraInfoModal" title="Configuration Details">
        <dl class="row mb-0">

            <dt class="col-sm-4 font-weight-bold">Description : </dt>
            <dd class="col-sm-8">{{ $editing->description ?? '—' }}</dd>


        </dl>
    </x-modal>

</div>

@push('scripts')
<script>
    window.addEventListener('show-config-modal', () => {
        $('#extraInfoModal').modal('show');
    });
</script>
@endpush
