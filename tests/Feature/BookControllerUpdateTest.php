<?php

namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookControllerUpdateTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function update_a_book_successfully()
    {
        Book::factory()->count(5)->create();

        // Select the first book to be updated
        $book = Book::first();

        // Data to update the book
        $validatedData = [
            'title' => 'John went to Harvard',
            'author' => 'Timothy Gardner',
            'rating' => 5,
        ];

        $response = $this->putJson(route('books.update', $book->id), $validatedData);

         $response->assertStatus(200)
            ->assertJson([
                'message' => 'Successfully updated the book.',
                'data' => [
                    'id' => $book->id,
                    'title' => 'John went to Harvard',
                    'author' => 'Timothy Gardner',
                    'rating' => 5,
                ]
            ]);

        // Ensure the database has the updated book record
        $this->assertDatabaseHas('books', [
            'id' => $book->id,
            'title' => 'John went to Harvard',
            'author' => 'Timothy Gardner',
            'rating' => 5,
        ]);
    }
}
