<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ActionButtonGroup extends Component
{
    public $buttons;

    public function __construct($buttons =[])
    {
        $this->buttons = $buttons;
    }

    public function render()
    {
        return view('components.action-button-group');
    }
}
