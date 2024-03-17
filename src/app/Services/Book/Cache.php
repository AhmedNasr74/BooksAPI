<?php

namespace App\Services\Book;

use Illuminate\Support\Facades\Cache as CacheDriver;
class Cache implements SearchBook
{
    public function search($isbn)
    {
        $isbn_cache_key = 'book_' . $isbn;

        if (CacheDriver::has($isbn_cache_key)) {
            return CacheDriver::get($isbn_cache_key);
        }

        return null;
    }
}
