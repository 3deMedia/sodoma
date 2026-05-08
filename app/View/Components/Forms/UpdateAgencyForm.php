<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class UpdateAgencyForm extends Component
{
    public $profile;
    public $admin;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($profile,$admin)
    {
        $this->profile=$profile;
        $this->admin= $admin;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.update-agency');
    }
}
