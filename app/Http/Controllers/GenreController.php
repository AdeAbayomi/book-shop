<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGenreRequest;
use App\Models\Genre;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::all();

        return response()->json([
            'message' => 'Successfully fetched the genres.',
            'data' => $genres
        ]);
    }

    public function store(StoreGenreRequest $request)
    {
        $validatedData = $request->validated();

        $genre = Genre::create(['name' => $validatedData['name']]);

        return response()->json([
            'message' => 'Successfully created the genre.',
            'data' => $genre
        ]);
    }
}

