<?php

namespace App\View\Components;

use Illuminate\View\Component;

class tabs extends Component
{

    public $routeTo;
    public $routeCurrent;
    public $title;
    public $isEdit;
    public $model;

    public function __construct($routeTo, $routeCurrent, $title, $isEdit = false, $model = null)
    {
        $this->routeTo = $routeTo;
        $this->routeCurrent = $routeCurrent;
        $this->title = $title;
        $this->isEdit = $isEdit;
        $this->model = $model;
    }

    public function render()
    {
        return view('components.tabs');
    }
}
