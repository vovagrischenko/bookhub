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
    public bool $ContainerToggle = false;

//    protected function rules()
//    {
//        return [
//            'name' => 'required|string',
//            'password' => 'required|max:8',
//            'email' => 'required|email'
//        ];
//    }

    public function register()
    {
//        dd($this);
//        $validated_data = $this->validate([
//            'name' => 'required|string',
//            'password' => 'required',
//            'email' => 'required|email'
//        ]);

        $this->pull('name');
        dd($validated_data);
        $user = User::create($validated_data);

        return true;
    }

    public function login(Request $request)
    {
//        dd($request);
//        $credentials = $request->validate();
        $this->validate();
        dd("kek");
//        if (Auth::attempt($credentials)) {
//            $request->session()->regenerate();
//            return redirect()->intended('/home')->with('success', 'Вы успешно вошли!');
//        }

        return back()->withErrors([
            'email' => 'Неверные учётные данные.',
        ]);
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
    <form wire:submit="login" {{ $this->ContainerToggle ? '' : 'hidden' }}>
        <flux:card class="space-y-6 w-sm">
            <div>
                <flux:heading size="lg">Авторизация bookhub</flux:heading>
                <flux:text class="mt-2">Добро пожаловать!</flux:text>
            </div>

            <div class="space-y-6">
                <flux:input wire:model="email" label="Email" type="email" placeholder="Your email address" />

                <flux:field>
                    <div class="mb-3 flex justify-between">
                        <flux:label>Password</flux:label>
                    </div>

                    <flux:input wire:model="password" type="password" placeholder="Your password" />

                    <flux:error name="password" />
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

                <flux:input label="Имя пользователя" type="text" placeholder="Валерий" />
                <flux:input label="Почта" type="email" placeholder="exnample@mail.ru" />

                <flux:field>
                    <div class="mb-3 flex justify-between">
                        <flux:label>Пароль</flux:label>
                    </div>

                    <flux:input type="password" placeholder="Ваш пароль" />

                    <flux:error name="password" />
                </flux:field>
            </div>

            <div class="space-y-2">
                <flux:button variant="primary" class="w-full" type="submit">Зарегистрироваться и войти</flux:button>
                <flux:button variant="ghost" class="w-full" wire:click="switchContainer()">Перейти к авторизации</flux:button>
            </div>
        </flux:card>
    </form>
</flux:main>
