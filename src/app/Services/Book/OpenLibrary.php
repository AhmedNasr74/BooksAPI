<?php

namespace App\Services\Book;

use Illuminate\Support\Facades\Http;

class OpenLibrary
{
    public function search($isbn)
    {
        $http = Http::get('https://openlibrary.org/search.json', [
            'q' => $isbn
        ]);

        return $http->json('docs.0');
    }
}
