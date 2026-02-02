<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Event;

class ArchivePastEvents extends Command
{
    protected $signature = 'events:archive-past';
    protected $description = 'Archive events that have already started in the past';

    public function handle()
    {
        $now = now();
        $eventsToArchive = Event::where('is_archived', false)
                    ->where('starts_at', '<', $now)->get();
        foreach ($eventsToArchive as $event) {
            $event->is_archived = true;
            $event->save();
        }
        $this->info('Archived ' . $eventsToArchive->count() . ' events.');
    }
}