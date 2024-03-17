<?php

namespace App\Listeners;

use App\Events\BookRetrievedEvent;
use Illuminate\Support\Facades\Cache;

class BookRetrievedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param BookRetrievedEvent $event
     * @return void
     */
    public function handle(BookRetrievedEvent $event)
    {
        if (!Cache::has('book_' . $event->getIsbn())) {
            Cache::put('book_' . $event->getIsbn(), $event->getBook(), now()->addMonth());
        }
    }
}
