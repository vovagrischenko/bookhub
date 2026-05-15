<?php

use Livewire\Component;

new class extends Component
{
    public function logout()
    {
        auth()->logout();
        return redirect('/login');
    }
};
?>

<flux:dropdown position="top" align="start" class="max-lg">
    <flux:sidebar.profile name="{{ auth()->user()->name }}" />
    <flux:menu>
        <flux:menu.item icon="arrow-right-start-on-rectangle" wire:click="logout">Выйти</flux:menu.item>
    </flux:menu>
</flux:dropdown>
