<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use Livewire\Attributes\On; 
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Wishlist;


class Functions extends Component
{
   

    public function render()
    {
        return view('livewire.frontend.home')
        ->layout('components.master');
    }

}
