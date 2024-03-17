<?php

namespace App\Http\Controllers;

use App\Events\BookRetrievedEvent;
use App\Services\Book\OpenLibrary;
use App\Services\Book\SearchBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class BookController extends Controller
{
    public function search(Request $request, SearchBook $library)
    {
        $isbn = $request->get('isbn');

        $book = $library->search($isbn);

        if ($book) {
            BookRetrievedEvent::dispatch($request->get('isbn'), $book);

            return response()->json([
                'data' => [
                    'book_name' => $book
                ],
                'source' => class_basename($library),
                'message' => 'Book Found Successfully',
            ]);
        }

        return response()->json([
            'data' => null,
            'message' => 'Book Not Found'
        ], Response::HTTP_NOT_FOUND);
    }
}
