<?php

namespace App\Http\Controllers;

use App\Events\BookRetrievedEvent;
use App\Services\Book\OpenLibrary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class BookController extends Controller
{
    public function search(Request $request, OpenLibrary $library)
    {
        $isbn = $request->get('isbn');

        $isbn_cache_key = 'book_' . $isbn;

        $is_book_cached = Cache::has($isbn_cache_key);

        $book = $is_book_cached ?  Cache::get($isbn_cache_key)  : $library->search($isbn);

        if ($book) {
            BookRetrievedEvent::dispatchIf(!$is_book_cached, $request->get('isbn'), $book);

            return response()->json([
                'data' => collect($book)->only('title'),
                'message' => 'Book Found Successfully',
                'source' => $is_book_cached ? 'Cache' : 'Service'
            ]);
        }

        return response()->json([
            'data' => null,
            'message' => 'Book Not Found'
        ], Response::HTTP_NOT_FOUND);
    }
}
