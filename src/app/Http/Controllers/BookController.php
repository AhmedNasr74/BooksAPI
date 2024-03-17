<?php

namespace App\Http\Controllers;

use App\Services\Book\OpenLibrary;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BookController extends Controller
{
    public function search(Request $request, OpenLibrary $library)
    {
        $book = $library->search($request->get('isbn'));

        if ($book) {
            return response()->json([
                'data' => collect($book)->only('title'),
                'message' => 'Book Found Successfully'
            ]);
        }

        return response()->json([
            'data' => null,
            'message' => 'Book Not Found'
        ], Response::HTTP_NOT_FOUND);
    }
}
