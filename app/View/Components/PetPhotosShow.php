<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PetPhotosShow extends Component
{
    public $pet;

    public function __construct($pet)
    {
        $this->pet = $pet;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.pet-photos-show');
    }
}
