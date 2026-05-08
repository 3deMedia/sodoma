<?php

namespace App\View\Components;

use Illuminate\View\Component;

class InactiveEscorts extends Component
{
    public $unactive ;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($unactive)
    {
        $this->unactive=$unactive;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('user.agency.tabs.inactive-escorts');
    }
}
