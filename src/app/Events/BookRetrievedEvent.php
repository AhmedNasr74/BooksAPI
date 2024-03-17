<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class BookRetrievedEvent
{
    use Dispatchable, SerializesModels;

    /**
     * @var mixed
     */
    private $book;
    /**
     * @var mixed
     */
    private $isbn;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($isbn, $book)
    {
        $this->book = $book;
        $this->isbn = $isbn;
    }

    public function getBook()
    {
        return $this->book;
    }
    public function getIsbn()
    {
        return $this->isbn;
    }
}
