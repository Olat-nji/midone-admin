<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ActionMessage extends Component
{
    // public $on;
    // /**
    //  * Create a new component instance.
    //  *
    //  * @return void
    //  */
    // public function __construct($on='')
    // {
    //     $this->on=$on;
    // }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.action-message');
    }
}
