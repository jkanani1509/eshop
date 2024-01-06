<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Models\User;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



class Login extends Component
{
    public $users, $email, $password, $name;
    public $registerForm = false;

    

    public function render()
    {
        return view('livewire.auth.login')
        ->layout('components.master');
    }

    private function resetInputFields(){
        $this->name = '';
        $this->email = '';
        $this->password = '';
    }

    public function login()
    {
        
        $validatedDate = $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        // dd($this->password);
        if(Auth::attempt(array('email' => $this->email, 'password' => $this->password))){
            $route = $this->redirectDash();
            return $this->redirect($route, navigate:true);
        }else{
            session()->flash('error', 'email and password are wrong.');
            return $this->redirect('login', navigate:true);
            
        }
    }

    public function redirectDash()
    {
        $redirect = '';

        if(Auth::user() && Auth::user()->role == 'user'){
            $redirect = '/';
        }
        else if(Auth::user() && Auth::user()->role == 'admin'){
            $redirect = 'admin/dashboard';
        }
        else{
            $redirect = '/login';
        }

        return $redirect;
    }
    
}
