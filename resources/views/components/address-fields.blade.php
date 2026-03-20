<div class="container-fluid">
    <div class="row">
        {{-- Address Line 1 --}}
        <div class="form-group col-md-6">
            <label>Address Line 1</label>
            <input type="text" class="form-control @error($modelPrefix.'address_line_1') is-invalid @enderror"
                   wire:model.defer="{{ $modelPrefix }}address_line_1">
            @error($modelPrefix.'address_line_1') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Address Line 2 --}}
        <div class="form-group col-md-6">
            <label>Address Line 2</label>
            <input type="text" class="form-control @error($modelPrefix.'address_line_2') is-invalid @enderror"
                   wire:model.defer="{{ $modelPrefix }}address_line_2">
            @error($modelPrefix.'address_line_2') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>

    <div class="row">
        {{-- Town or City --}}
        <div class="form-group col-md-6">
            <label>Town or City</label>
            <input type="text" class="form-control @error($modelPrefix.'town_or_city') is-invalid @enderror"
                   wire:model.defer="{{ $modelPrefix }}town_or_city">
            @error($modelPrefix.'town_or_city') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- County --}}
        <div class="form-group col-md-6">
            <label>County</label>
            <input type="text" class="form-control @error($modelPrefix.'county') is-invalid @enderror"
                   wire:model.defer="{{ $modelPrefix }}county">
            @error($modelPrefix.'county') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>

    <div class="row">
        {{-- Postcode --}}
        <div class="form-group col-md-6">
            <label>Postcode</label>
            <input type="text" class="form-control @error($modelPrefix.'postcode') is-invalid @enderror"
                   wire:model.defer="{{ $modelPrefix }}postcode">
            @error($modelPrefix.'postcode') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Country --}}
        <div class="form-group col-md-6">
            <label>Country</label>
            <input type="text" class="form-control @error($modelPrefix.'country') is-invalid @enderror"
                   wire:model.defer="{{ $modelPrefix }}country">
            @error($modelPrefix.'country') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>
</div>
