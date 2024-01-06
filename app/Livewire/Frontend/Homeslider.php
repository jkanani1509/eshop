<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Banner;


class Homeslider extends Component
{
    public function render()
    {
        $banners=Banner::where('status','active')->limit(3)->orderBy('id','DESC')->get();
        return view('livewire.frontend.homeslider')
        ->with('banners',$banners);
    }
}
