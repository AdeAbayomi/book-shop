<?php

namespace App\Http\Controllers;

use App\Http\Requests\Book\DestroyRequest;
use App\Http\Requests\Book\IndexRequest;
use App\Http\Requests\Book\StoreRequest;
use App\Http\Requests\Book\UpdateRequest;
use App\Http\Services\Book\Destroy;
use App\Http\Services\Book\Index;
use App\Http\Services\Book\Store;
use App\Http\Services\Book\Update;
use App\Models\Book;
use App\Models\Genre;

class BookController extends Controller
{
    public function index(IndexRequest $request, Index $index)
    {
        return response()->json([
            'message' => 'Successfully fetched the books.',
            'data' => $index()
        ]);
    }

    public function show(Book $book)
    {
        return response()->json([
            'message' => 'Successfully fetched the book.',
            'data' => $book
        ]);
    }

    public function store(StoreRequest $request, Store $store)
    {
        $validatedData = $request->validated();
        $genres = $validatedData['genres'] ?? [];
        unset($validatedData['genres']);

        $book = $store($validatedData);
        $book->genres()->sync($genres);

        return response()->json([
            'message' => 'Successfully stored the book.',
            'data' => $book->load('genres')
        ]);
    }

    public function update(UpdateRequest $request, Update $update, Book $book)
    {
        $validatedData = $request->validated();
        $genres = $validatedData['genres'] ?? [];
        unset($validatedData['genres']);

        $updatedBook = $update($validatedData, $book);
        $updatedBook->genres()->sync($genres);

        return response()->json([
            'message' => 'Successfully updated the book.',
            'data' => $updatedBook->load('genres')
        ]);
    }

    public function destroy(DestroyRequest $request, Destroy $destroy, Book $book)
    {
        $destroy($book);

        return response()->json([
            'message' => 'Successfully deleted the book.',
        ]);
    }
}
