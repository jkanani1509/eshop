<?php

namespace App\Livewire\Frontend;

use Livewire\Component;

class AboutUs extends Component
{
    public function render()
    {
        return view('livewire.frontend.about-us')
        ->layout('components.master');
    }
}
