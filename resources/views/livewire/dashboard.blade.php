<?php

use Livewire\Volt\Component;
use App\Models\ListeningParty;

new class extends Component {
    public string $name = '';
    public $startTime;

    public function createListeningParty() {}

    public function with()
    {
        return [
            'listening_parties' => ListeningParty::all(),
        ];
    }
}; ?>

<div class="flex items-center justify-center min-h-screen bg-slate-50">
    <div class="max-w-lg w-full px-4">
        <form wire:submit='createListeningParty' class='space-y-3'>
            <x-input wire:model='name' placeholder="Listening party name" />
            <x-datetime-picker wire:model='startTime' placeholder="Listening startTime" />
            <x-button primary style="color: white;"> Create </x-button>
        </form>
    </div>
</div>
