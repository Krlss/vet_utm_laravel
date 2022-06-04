<?php

namespace App\View\Components;

use Illuminate\View\Component;

class cardHome extends Component
{
    public $value;
    public $small;
    public $icon;
    public $route;
    public $bg;
    public $color;



    public function __construct($value, $small, $icon = null, $route = null, $bg = null, $color = null)
    {
        $this->value = $value;
        $this->small = $small;
        $this->icon = $icon;
        $this->route = $route;
        $this->bg = $bg;
        $this->color = $color;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.card-home');
    }
}
