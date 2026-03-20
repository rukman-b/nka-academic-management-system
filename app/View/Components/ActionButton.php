<?php


namespace App\View\Components;

use Illuminate\View\Component;

class ActionButton extends Component
{
    public $method;
    public $params;
    public $label;
    public $confirm;
    public $confirmMessage;
    public $tooltip;
    public $icon;
    public $variant;
    public $swalType;
    public $buttonType;
    public $dispatch;

    public function __construct(
        $method = null,
        $params = null,
        $label = null,
        $confirm = false,
        $confirmMessage = null,
        $tooltip = null,
        $icon = null,
        $variant = null,
        $swalType = null,
        $buttonType = 'edit',
        // $dispatch = false //cleaning version 1
    ) {
        $this->method = $method;
        $this->params = $params;
        $this->label = isset($label) ? ucfirst(strtolower($label)) : null;
        $this->confirm = filter_var($confirm, FILTER_VALIDATE_BOOLEAN);
        $this->confirmMessage = $confirmMessage ?? "Are you sure you want to {$this->label}?";
        $this->tooltip = $tooltip;
        // $this->dispatch = filter_var($dispatch, FILTER_VALIDATE_BOOLEAN); //cleaning version 1
        $this->buttonType = strtolower($buttonType);

        switch ($this->buttonType) {
            case 'delete':
                $this->icon = $icon ?? 'fas fa-trash fa-xs';
                $this->variant = $variant ?? 'danger';
                $this->swalType = $swalType ?? 'warning';
                $this->label = $this->label ?? 'Delete';
                $this->confirm = true;
                break;
            case 'edit':
                $this->icon = $icon ?? 'far fa-edit fa-xs';
                $this->variant = $variant ?? 'warning';
                $this->swalType = $swalType ?? 'info';
                $this->label = $this->label ?? 'Edit';
                break;
            case 'update':
                $this->icon = $icon ?? 'fas fa-sync-alt fa-xs';
                $this->variant = $variant ?? 'success';
                $this->swalType = $swalType ?? 'info';
                $this->label = $this->label ?? 'Update';
                break;
            case 'create':
                $this->icon = $icon ?? 'fas fa-plus fa-xs';
                $this->variant = $variant ?? 'success';
                $this->swalType = $swalType ?? 'info';
                $this->label = $this->label ?? 'Create';
                break;
            case 'cancel':
                $this->icon = $icon ?? 'fas fa-times fa-xs';
                $this->variant = $variant ?? 'primary';
                $this->swalType = $swalType ?? 'info';
                $this->label = $this->label ?? 'Cancel';
                break;
            case 'view':
                $this->icon = $icon ?? 'fas fa-eye fa-xs';
                $this->variant = $variant ?? 'success';
                $this->swalType = $swalType ?? 'info';
                $this->label = $this->label ?? 'view';
                break;
        }

        $this->confirmMessage = $confirmMessage ?? "Are you sure you want to {$this->label}?";
    }

    public function render()
    {
        return view('components.action-button');
    }

    
}
