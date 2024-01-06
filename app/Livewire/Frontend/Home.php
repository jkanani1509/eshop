<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use Livewire\Attributes\On; 
use App\Models\Wishlist;

class Home extends Component
{
    
    public function render()
    {
        return view('livewire.frontend.home')
        ->layout('components.master');
    }
}
