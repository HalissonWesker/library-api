<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Book;
use App\Models\User;
use App\Models\Author;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BookApiTest extends TestCase
{
    use DatabaseTransactions;

    public function test_book_creation()
    {
        $user = User::factory()->create(['role' => 'admin']);
        $author = Author::factory()->create();

        $response = $this->actingAs($user, 'api')->postJson('/api/books', [
            'title' => 'New Book Title',
            'publication_year' => 2023,
            'author_id' => $author->id,
        ]);

        $response->assertStatus(201)
                 ->assertJson([
                     'title' => 'New Book Title',
                     'publication_year' => 2023,
                     'author_id' => $author->id,
                 ]);
    }

    public function test_book_listing()
    {
        $user = User::factory()->create(['role' => 'admin']);
        $author = Author::factory()->create();

        $book = Book::factory()->create([
            'title' => 'Listed Book',
            'publication_year' => 2021,
            'author_id' => $author->id,
        ]);

        $response = $this->actingAs($user, 'api')->getJson('/api/books');

        $response->assertStatus(200)
                 ->assertJsonFragment([
                     'title' => 'Listed Book',
                 ]);
    }

    public function test_book_updating()
    {
        $user = User::factory()->create(['role' => 'admin']);
        $author = Author::factory()->create();

        $book = Book::factory()->create([
            'title' => 'Old Title',
            'publication_year' => 2021,
            'author_id' => $author->id,
        ]);

        $response = $this->actingAs($user, 'api')->putJson("/api/books/{$book->id}", [
            'title' => 'Updated Title',
            'publication_year' => 2022,
        ]);

        $response->assertStatus(200)
                 ->assertJson([
                     'title' => 'Updated Title',
                     'publication_year' => 2022,
                 ]);
    }

    public function test_book_deletion()
    {
        $user = User::factory()->create();
        $author = Author::factory()->create();

        $book = Book::factory()->create([
            'title' => 'Book to Delete',
            'publication_year' => 2020,
            'author_id' => $author->id,
        ]);

        $response = $this->actingAs($user, 'api')->deleteJson("/api/books/{$book->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('books', ['id' => $book->id]);
    }
}
