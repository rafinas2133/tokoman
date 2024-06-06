<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class customModal extends Component
{
    /**
     * Create a new component instance.
     */
    public $parrent;
     public function __construct($parrent)
    {
        $this->parrent = $parrent;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.custom-modal');
    }
}
