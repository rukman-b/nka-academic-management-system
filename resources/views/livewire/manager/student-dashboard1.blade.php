<div class="row justify-content-center">
    <div class="col-md-8">

        {{-- Card 1: Student & Programme Info --}}
        <div class="card card-primary">
            <div class="card-header"><h4>Welcome, {{ $student->name }}</h4></div>
            <div class="card-body">
                <p><strong>Email:</strong> {{ $student->email }}</p>
                <p><strong>Phone:</strong> {{ $student->phone }}</p>

                @foreach($batches as $batch)
                    <hr>
                    <p><strong>Batch ID:</strong> {{ $batch->id }}</p>
                    <p><strong>Programme:</strong> {{ $batch->config->programme->name }}</p>
                    <p><strong>Level:</strong> {{ $batch->config->level->name ?? 'N/A' }}</p>
                    <p><strong>Duration:</strong> {{ $batch->config->duration }} months</p>
                    <p><strong>Delivery:</strong> {{ $batch->config->delivery_method }}</p>
                    <p><strong>Pass Mark:</strong> {{ $batch->config->pass_marks }}%</p>
                @endforeach
            </div>
        </div>

        {{-- Card 2: Modules Breakdown --}}
        @foreach($batches as $batch)
            <div class="card card-info">
                <div class="card-header">
                    <h5>Modules - {{ $batch->config->programme->name }} (Batch {{ $batch->code }})</h5>
                </div>
                <div class="card-body">
                    <h6><strong>Core Modules</strong></h6>
                    <ul>
                        @foreach($batch->config->configLevelModules->where('is_optional', false) as $core)
                            <li>{{ $core->module->name }} (Level {{ $core->level->name ?? 'N/A' }})</li>
                        @endforeach
                    </ul>

                    <h6 class="mt-3"><strong>Optional Modules (Selected)</strong></h6>
                    <ul>
                        @php
                            $selectedIds = $student->studentOptionalModules->pluck('config_level_module_id')->toArray();
                            print_r($selectedIds);
                        @endphp
                        @foreach($batch->config->configLevelModules->where('is_optional', true) as $opt)
                            @php
                                echo '<br>'.($opt->id).'<br>';
                            @endphp
                            @if(in_array($opt->id, $selectedIds))
                                <li>{{ $opt->module->name }} (Level {{ $opt->level->name ?? 'N/A' }})</li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        @endforeach

    </div>
</div>
