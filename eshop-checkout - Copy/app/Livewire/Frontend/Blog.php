<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\Post;
use DB;

class Blog extends Component
{
    public function render()
    {
        
        
        // return $posts;
         $Blog=Post::getAllPost();
        // $blogs=Post::where('status','active')->orderBy('id','DESC')->get();  
        // $post=$blogs->toArray();
        // dd($blogs);

        return view('livewire.frontend.blog')
        ->with('posts', $Blog)
        ->layout('components.master');
    }
}
