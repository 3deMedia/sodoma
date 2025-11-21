<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AdminTopButtons extends Component
{
    public $profile;
    public $agencycost;
    public $escortcost;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($profile,$agencycost,$escortcost)
    {
        $this->profile=$profile;
        $this->agencycost=$agencycost;
        $this->escortcost=$escortcost;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin-top-buttons');
    }
}
