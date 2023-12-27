<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests;
use Illuminate\Support\Facades\Hash;

class Logout extends Component
{
    public function render()
    {
        Session::forget('user');
        Auth::logout();
        // request()->session()->flash('success','Logout successfully');
        return view('livewire.frontend.home')
        ->layout('components.master');
    
    }
}
