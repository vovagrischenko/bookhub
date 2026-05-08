<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class loginForm extends Form
{
    public string $name;
    public string $password;
    public string $email;

    protected function rules()
    {
        return [
            'name' => 'required|string',
            'password' => 'required|max:8',
            'email' => 'required|email'
        ];
    }

    public function submit(){

    }

    public function render(){
        return view('components.forms.login');
    }
}
