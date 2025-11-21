<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class UpdateEscortForm extends Component
{
    public $profile; // perfil escort
    public $admin;  // lo crea el admin
    public $agency; // perfil agencia

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($profile,$admin,$agency=null)
    {
        $this->profile=$profile;
        $this->$admin=$admin;
        $this->agency=$agency;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.update-escort');
    }
}
