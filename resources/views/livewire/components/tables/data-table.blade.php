<div>
    <div id="data-table" class="table-responsive">
        {{-- Export Button Section --}}
        @if ($enableExport && filled($exportOptions['route']))
            <x-export-button 
                :route="$exportOptions['route']"
                :label="($exportOptions['label'] ?? 'Export')"
                :filename="($exportOptions['filename'] ?? 'export')"
                :tooltip="($exportOptions['tooltip'] ?? null)"
            />
        @endif

        {{-- Pagination Controls --}}
        @if ($enablePagination)
            <div class="row mb-3 align-items-end">
                <div class="col-md-3">
                    <label for="perPage">Rows per page</label>
                    <select wire:model.live="perPage" id="perPage" class="form-control">
                        @foreach ([5, 10, 25, 50, 100] as $size)
                            <option value="{{ $size }}">{{ $size }} rows</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endif

        {{-- Search Controls --}}
        @if ($enableSearch)
            <div class="row mb-3">
                <div class="col-md-6">
                    <input
                        type="text"
                        wire:model.live.debounce.300ms="search"
                        class="form-control"
                        placeholder="Search {{ Str::headline($searchColumn) }}..."
                    >
                </div>

                <div class="col-md-6">
                    <select wire:model="searchColumn" class="form-control">
                        @foreach ($searchableColumns as $col)
                            <option value="{{ $col }}">{{ $columnLabels[$col] ?? Str::headline($col) }}</option> 
                        @endforeach
                    </select>
                </div>
            </div>
        @endif

        {{-- Data Table --}}
        {{-- <table class="table table-bordered table-hover table-sm table-striped" style="table-layout: fixed; width: 100%;"> --}}
         <table class="table table-bordered table-hover table-sm table-striped">
            {{-- <colgroup>
                @foreach ($columns as $column)
                    <col style="width: {{ 100 / (count($columns) + ($showActions ? 1 : 0)) }}%;">
                @endforeach

                @if ($showActions)
                    <col style="width: {{ 100 / (count($columns) + 1) }}%;">
                @endif
            </colgroup> --}}

            <thead class="thead-dark">
                <tr>
                    @foreach ($columns as $column)
                        <th class="text-nowrap"
                            @if (in_array($column, $sortableColumns))
                                wire:click="sortBy('{{ $column }}')"
                                style="cursor: pointer;"
                            @endif
                        >
                            {{ $columnLabels[$column] ?? Str::headline(Str::before($column, '.')) }}

                            @if (in_array($column, $sortableColumns))
                                @if ($sortColumn === $column)
                                    <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ml-1"></i>
                                @else
                                    <i class="fas fa-sort ml-1 text-muted"></i>
                                @endif
                            @endif
                        </th>
                    @endforeach

                    @if ($showActions)
                        <th class="text-center text-nowrap">Actions</th> 
                    @endif
                </tr>
            </thead>

            <tbody>
                @forelse ($rows as $row)
                    <tr>
                        @foreach ($columns as $col)
                            {{-- <td>{{ $this->getValue($row, $col) }}</td> --}}
                            <td class="align-middle">{!! $this->getSubstituteValue($row, $col) !!}</td>
                        @endforeach

                        @if ($showActions)
                            <td class="text-center text-nowrap">
                                @include($actionView, ['row' => $row])
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ count($columns) + ($showActions ? 1 : 0) }}" class="text-center">No records found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>

    {{-- Pagination Links --}}
    @if ($enablePagination)
        <div class="mt-2 d-flex justify-content-center">
            {{ $rows->links(data: ['scrollTo' => false]) }}
        </div>
    @endif
</div>
