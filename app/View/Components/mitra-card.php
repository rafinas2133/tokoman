<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class mitraCard extends Component
{
    public $mitra;
    /**
     * Create a new component instance.
     */
    public function __construct($mitra)
    {
        $this->mitra = $mitra;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.mitra-card');
    }
}
