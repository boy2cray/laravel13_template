<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ButtonLoading extends Component
{
    public $action;
    public $label;
    public $loadingLabel;

    public function __construct(
        $action = null,
        $label = 'Submit',
        $loadingLabel = 'Memproses...'
    ) {
        $this->action = $action;
        $this->label = $label;
        $this->loadingLabel = $loadingLabel;
    }

    public function render()
    {
        return view('components.button-loading');
    }
}