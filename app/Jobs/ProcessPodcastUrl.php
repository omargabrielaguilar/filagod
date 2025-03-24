<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessPodcastUrl implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $rssUrl;
    public $listeningParty;
    public $episode;

    /**
     * Create a new job instance.
     */
    public function __construct($rssUrl, $listeningParty, $episode)
    {
        $this->rssUrl = $rssUrl;
        $this->listeningParty = $listeningParty;
        $this->episode = $episode;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $xml = simplexml_load_file($this->rssUrl);

        dd($xml);
        $podcastTile = $xml->channel->title;
    }
}
