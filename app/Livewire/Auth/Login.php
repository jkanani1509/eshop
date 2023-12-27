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
            // dd("AAAAAAA");
                session()->flash('message', "You are Login successful.");
                // return redirect()->route('Home');
                return $this->redirect('/Home', navigate:true);
        }else{
            // dd("BBBBBBB");
            session()->flash('error', 'email and password are wrong.');
            // return redirect()->route('login');
            return $this->redirect('login', navigate:true);
            
        }
    }

    public function register()
    {
        $this->registerForm = !$this->registerForm;
    }

    public function registerStore()
    {
        $validatedDate = $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $this->password = Hash::make($this->password); 

        User::create(['name' => $this->name, 'email' => $this->email,'password' => $this->password]);

        session()->flash('message', 'Your register successfully Go to the login page.');

        $this->resetInputFields();

    }
}
