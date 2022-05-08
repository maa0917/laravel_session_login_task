<?php

namespace App\View\Components\Tasks;

use Illuminate\View\Component;

class Form extends Component
{
    public $task;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($task)
    {
        $this->task = $task;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.tasks.form');
    }
}
