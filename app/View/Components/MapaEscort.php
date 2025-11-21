<?php

namespace App\View\Components;

use Illuminate\View\Component;

class MapaEscort extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $center;


    public function __construct($center)
    {
        $this->center=$center;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.mapa-escort');
    }
}
