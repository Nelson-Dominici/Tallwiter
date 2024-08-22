<?php

namespace App\Livewire\Components;

use Livewire\Component;
use Illuminate\Support\Facades\URL;

class Menu extends Component
{
    public function render()
    {
        $currentRoute = request()->path();
        $previousRoute = ltrim(URL::previousPath(), '/');

        $selectButton = ($currentRoute == 'livewire/update') ? $previousRoute : $currentRoute;

        return view('livewire.components.menu', compact('selectButton'));
    }
}
