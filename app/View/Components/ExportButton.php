<?php
// app/View/Components/ExportButton.php

namespace App\View\Components;

use Illuminate\View\Component;

class ExportButton extends Component
{
    public string $route;
    public string $label;
    public string $filename;
    public ?string $tooltip;

    public function __construct(
        string $route,
        string $label = 'Export',
        string $filename = 'export',
        ?string $tooltip = null
    ) {
        $this->route = $route;
        $this->label = $label;
        $this->filename = $filename;
        $this->tooltip = $tooltip;
    }

    public function render()
    {
        return view('components.export-button');
    }
}
