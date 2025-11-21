<?php

namespace App\View\Components\Tables;

use Illuminate\View\Component;

class AdminEscortsList extends Component
{

    public $profiles;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($profiles)
    {
        $this->profiles=$profiles;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.tables.admin-escorts');
    }
}
