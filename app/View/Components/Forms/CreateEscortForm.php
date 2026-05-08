<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class CreateEscortForm extends Component
{

    public $admin;
    public $agency;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($admin,$agency=null)
    {
        $this->admin=$admin;
        $this->agency=$agency;


    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.create-escort');
    }
}
