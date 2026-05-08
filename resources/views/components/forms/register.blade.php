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
        <flux:button variant="ghost" class="w-full">Перейти к авторизации</flux:button>
    </div>
</flux:card>
</form>
