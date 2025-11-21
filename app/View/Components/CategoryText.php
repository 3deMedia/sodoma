<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CategoryText extends Component
{

    public $ctext;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($ctext)
    {
        $this->ctext=$ctext;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.category-text');
    }
}
