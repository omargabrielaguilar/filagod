<?php

use App\Jobs\ProcessPodcastUrl;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;
use App\Models\ListeningParty;
use App\Models\Episode;
use App\Jobs\ProcessPodcastUrl;

new class extends Component {
    #[Validate('required|string|max:255')]
    public string $name = '';

    #[Validate('required')]
    public $startTime;

    #[Validate('required|url')]
    public string $mediaUrl = '';

    public function createListeningParty()
    {
        $this->validate();

        $episode = Episode::create([
            'media_url' => $this->mediaUrl,
        ]);

        $listeningParty = ListeningParty::create([
            'episode_id' => $episode->id,
            'name' => $this->name,
            'start_time' => $this->startTime,
        ]);

        ProcessPodcastUrl::dispatch($this->mediaUrl, $listeningParty, $episode);

        return redirect()->route('parties.show', $listeningParty);
    }

    public function with()
    {
        return [
            'listening_parties' => ListeningParty::all(),
        ];
    }
}; ?>

<div class="flex items-center justify-center min-h-screen bg-slate-50">
    <div class="w-full max-w-lg px-4">
        <form wire:submit='createListeningParty' class='space-y-6'>
            <x-input wire:model='name' placeholder="Listening party name" />
            <x-input wire:model='mediaUrl' placeholder='URL podcast' description='RSS Feeds will grab the latest' />
            <x-datetime-picker wire:model='startTime' placeholder="Listening startTime" :min="now()->subDays(1)" />
            <x-button type="submit" style="color: white; font-weight:600;"> Create </x-button>
        </form>
    </div>
</div>
