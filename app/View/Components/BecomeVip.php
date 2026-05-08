<?php

namespace App\View\Components;

use Illuminate\View\Component;

class BecomeVip extends Component
{
    public $userType;
    // public $isVip;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($userType)//,$isVip
    {
        $this->userType=$userType;
        // $this->isVip=$isVip;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.become-vip');
    }
}
