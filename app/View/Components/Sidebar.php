<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;

class Sidebar extends Component
{
    public $mechanic;

    public function __construct()
    {
        $this->mechanic = Auth::user()->mechanic ?? null; 
    }

    public function render()
    {
        return view('components.sidebar');
    }
}
