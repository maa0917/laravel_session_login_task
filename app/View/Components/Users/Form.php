<?php

namespace App\View\Components\Users;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Form extends Component
{
    public $user;

    /**
     * @param $user
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * @return Application|Htmlable|Factory|View
     */
    public function render()
    {
        return view('components.users.form');
    }
}
