<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AgencyEscortsTabpanel extends Component
{
    public $agency;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($agency)
    {
        $this->agency=$agency;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.agency.agency-escorts-tabpanel');
    }
}
