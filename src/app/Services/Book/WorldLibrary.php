<?php

namespace App\Services\Book;

class WorldLibrary implements SearchBook
{
    public function search($isbn)
    {
        return 'World Library Book';
    }
}
