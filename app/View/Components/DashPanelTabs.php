<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DashPanelTabs extends Component
{
    public $profile;
    public $userType;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($profile,$userType)
    {
        $this->profile=$profile;
        $this->userType=$userType;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dash-panel-tabs');
    }
}
