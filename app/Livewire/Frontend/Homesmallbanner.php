<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use DB;

class Homesmallbanner extends Component
{
    public function render()
    {
        
        $category_lists=DB::table('categories')->where('status','active')->limit(3)->get();
        return view('livewire.frontend.homesmallbanner')
        ->with('category_lists',$category_lists);

        
    }
}
