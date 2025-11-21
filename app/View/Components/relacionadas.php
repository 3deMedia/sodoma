<?php

namespace App\View\Components;

use Illuminate\View\Component;

class relacionadas extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $relacionadas;

    public function __construct($relacionadas)
    {
       $this->relacionadas = $relacionadas;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.relacionadas');
    }
}
