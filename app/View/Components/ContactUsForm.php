<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ContactUsForm extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $profile;

    public function __construct($profile)
    {
        //
        $this->profile=$profile;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.contact-us-form');
    }
}
