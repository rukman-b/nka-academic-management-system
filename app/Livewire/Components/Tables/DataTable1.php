<?php

namespace App\Livewire\Components\Tables;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;

class DataTable extends Component
{
    use WithPagination;

    public array $exportOptions = []; //Export partial
    public array $searchableColumns = []; // Cached search-safe columns
    public array $sortableColumns = [];   // Cached sort-safe columns

    protected $paginationTheme = 'bootstrap';

    // Externally configurable (from Blade)
    public string $model;
    public array $columns = [];
    public bool $enableExport = true;

    // Pagination
    // #[Url]
    public int $perPage = 10;
    public bool $enablePagination = true; 

    // Search
    public bool $enableSearch = false;
    public string $search = '';
    public string $searchColumn = 'name';

    // Sort
    public bool $enableSort = true;
    public string $sortColumn = '';
    public string $sortDirection = 'desc';

    // Labels
    public array $columnLabels = [];

    //Substitute
    public array $substituteColValues = [];

    public bool $showActions = false; // optional, off by default
    public ?string $actionView = null;   // Blade view partial for buttons


    public function getSubstituteValue($row, $col): string
    {
        $value = $this->getValue($row, $col);

        if (isset($this->substituteColValues[$col][$value])) {
            return $this->substituteColValues[$col][$value];
        }

        return $value;
    }

    public function mount()
    {
        // dd($this->substituteColValue);
        $this->enableSearch = filter_var($this->enableSearch, FILTER_VALIDATE_BOOLEAN);
        $this->enableSort   = filter_var($this->enableSort, FILTER_VALIDATE_BOOLEAN);
        $this->enableExport = filter_var($this->enableExport, FILTER_VALIDATE_BOOLEAN);
        $this->showActions  = filter_var($this->showActions, FILTER_VALIDATE_BOOLEAN);

        if (empty($this->columns)) {
            throw new \Exception("The 'columns' property must be defined for DataTable.");
        }

        if (!isset($this->model)) {
            throw new \Exception("The 'model' property must be defined for DataTable.");
        }

        if ($this->showActions && empty($this->actionView)) {
            throw new \Exception("You must set 'actionView' when 'showActions' is true.");
        }

        // Cache filtered column types
        $this->searchableColumns = collect($this->columns)
            ->reject(fn($col) => Str::contains($col, '.') || Str::endsWith($col, '_list'))
            ->values()
            ->all();

        $this->sortableColumns = collect($this->columns)
            ->reject(fn($col) => Str::contains($col, '.') || Str::endsWith($col, '_list'))
            ->values()
            ->all();
    }

    public function render()
    {
        $query = $this->getModelQuery();

        return view('livewire.components.tables.data-table', [
            'rows' => $this->enablePagination
                ? $query->paginate($this->perPage)
                : $query->get(),
        ]);
    }

    protected function getModelQuery(): Builder
    {
        $query = app($this->model)::query();

        // Search
        if ($this->enableSearch && !empty($this->search)) {
            $query->where($this->searchColumn, 'like', '%' . $this->search . '%');
        }

        // Sort (only valid columns)
        if ($this->enableSort && in_array($this->sortColumn, $this->sortableColumns)) {
            $query->orderBy($this->sortColumn, $this->sortDirection);
        }

        // Eager-load nested relations
        $relations = collect($this->columns)
            ->filter(fn($col) => Str::contains($col, '.'))
            ->map(fn($col) => Str::before($col, '.'))
            ->unique()
            ->values()
            ->all();

        if (!empty($relations)) {
            $query->with($relations);
        }

        return $query;
    }

    public function updatedPerPage(): void
    {
        $this->resetPage();
    }

    protected function getValue($row, string $column)
    {
        return data_get($row, $column);
    }

    public function sortBy(string $column): void
    {
        if (!in_array($column, $this->sortableColumns)) {
            return; // ignore non-sortable columns
        }

        if ($this->sortColumn === $column) {
            $this->sortDirection = $this->sortDirection === 'desc' ? 'asc' : 'desc';
        } else {
            $this->sortColumn = $column;
            $this->sortDirection = 'desc';
        }

        $this->resetPage();
    }
}
