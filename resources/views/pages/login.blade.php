<?php
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Livewire\Attributes\Validate;

new class extends Component
{
    public string $name;
    public string $password;
    public string $email;
    public bool $remember = false;
    public bool $ContainerToggle = true;

    public function register()
    {
        if(User::where('email', $this->email)->exists()){
            session()->flash('error', 'Пользователь с данной почтой уже зарегистрирован');
            return true;
        }

        $user = new User();
        $user->email = $this->email;
        $user->name = $this->name;
        $user->password = Hash::make($this->password);
        $user->save();
        $this->login();

        return true;
    }

    public function login()
    {
        if (Auth::attempt(['email' => $this->email, 'password' => $this->password]))
            return redirect('/posts');
        else
            session()->flash('error', 'Неверные учётные данные');
        return true;
    }

    public function switchContainer()
    {
        $this->ContainerToggle = !$this->ContainerToggle;
    }

    public function render()
    {
        return view('pages.login')->extends('layouts.empty');
    }
}
?>

<flux:main class="flex justify-center mt-[10%]">
    <div>
        <div {{!session('error') ? 'hidden' : ''}}>
            <flux:callout variant="danger" icon="x-circle" x-data="{ visible: true }" x-show="visible" inline="">
                <flux:callout.heading class="flex gap-2 @max-md:flex-col items-start">Ошибка<flux:text>{{session('error')}}</flux:text></flux:callout.heading>
                <x-slot name="controls">
                    <flux:button icon="x-mark" variant="ghost" x-on:click="visible = false" />
                </x-slot>
            </flux:callout>
        </div>

        <br>

        <form wire:submit="login" {{ $this->ContainerToggle ? '' : 'hidden' }}>
            <flux:card class="space-y-6 w-sm">
                <div>
                    <flux:heading size="lg">Авторизация bookhub</flux:heading>
                    <flux:text class="mt-2">Добро пожаловать!</flux:text>
                </div>
                <div class="space-y-6">
                    <flux:input wire:model="email" label="Email" type="email" placeholder="Your email address" required />
                    <flux:field>
                        <div class="mb-3 flex justify-between">
                            <flux:label>Password</flux:label>
                        </div>
                        <flux:input wire:model="password" type="password" placeholder="Your password" required />
                    </flux:field>
                </div>
                <div class="space-y-2">
                    <flux:button variant="primary" class="w-full" type="submit">Войти</flux:button>
                    <flux:button variant="ghost" class="w-full" wire:click="switchContainer()">Вход с новой учётной записью</flux:button>
                </div>
            </flux:card>
        </form>

        <form wire:submit="register" {{ !$this->ContainerToggle ? '' : 'hidden' }}>
            <flux:card class="space-y-6 w-sm">
                <div>
                    <flux:heading size="lg">Войти в bookhub</flux:heading>
                    <flux:text class="mt-2">Добро пожаловать!</flux:text>
                </div>
                <div class="space-y-6">
                    <flux:input wire:model="name" label="Имя пользователя" type="text" placeholder="Валерий" required />
                    <flux:input wire:model="email" label="Почта" type="email" placeholder="exnample@mail.ru" required />
                    <flux:field>
                        <div class="mb-3 flex justify-between">
                            <flux:label>Пароль</flux:label>
                        </div>
                        <flux:input wire:model="password" type="password" placeholder="Ваш пароль" required />
                    </flux:field>
                </div>
                <div class="space-y-2">
                    <flux:button variant="primary" class="w-full" type="submit">Зарегистрироваться и войти</flux:button>
                    <flux:button variant="ghost" class="w-full" wire:click="switchContainer()">Перейти к авторизации</flux:button>
                </div>
            </flux:card>
        </form>
    </div>
</flux:main>
