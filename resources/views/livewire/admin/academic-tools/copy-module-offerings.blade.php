
<div>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header"><h3 class="card-title">Copy Module Offerings</h3></div>
                <div class="card-body">
                    <div class="form-group">
                        <label>From Academic Year</label>
                        <select wire:model="fromYear" class="form-control">
                            <option value="">-- Select Year --</option>
                            @foreach($availableYears as $year)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endforeach
                        </select>
                        @error('fromYear') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label>To Academic Year</label>
                        <select wire:model="toYear" class="form-control">
                            <option value="">-- Select Year --</option>
                            @foreach($availableYears as $year)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endforeach
                        </select>
                        @error('toYear') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <button wire:click="copy" class="btn btn-success">Copy Offerings</button>

                    @if ($status)
                        <div class="alert alert-info mt-3">{{ $status }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>