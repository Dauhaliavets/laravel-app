<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\support\Facades\Http;

class NotifyAdmin implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct() {}

    /**
     * Handle the event.
     */
    public function handle(UserRegistered $event): void
    {
        Http::post(config('services.slack.webhook'), [
            'text' => "New user: {$event->email}",
        ]);
    }
}
