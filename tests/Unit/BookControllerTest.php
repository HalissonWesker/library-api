<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Book;
use App\Services\BookService;
use App\Http\Controllers\BookController;
use Illuminate\Http\Request;
use Mockery;

class BookControllerTest extends TestCase
{
    protected $bookService;
    protected $bookController;

    public function setUp(): void
    {
        parent::setUp();

        $this->bookService = Mockery::mock(BookService::class);
        $this->bookController = new BookController($this->bookService);
    }

    public function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_index_returns_all_books()
    {
        $books = Book::factory()->count(3)->make();

        $this->bookService->shouldReceive('getAllBooks')
                          ->once()
                          ->andReturn($books);

        $response = $this->bookController->index();

        $this->assertEquals(200, $response->status());
        $this->assertEquals($books->toArray(), $response->getData(true));
    }

    public function test_store_creates_new_book()
    {
        $request = Request::create('/api/books', 'POST', [
            'title' => 'Test Book',
            'publication_year' => '2022',
            'author_id' => 1,
        ]);

        $book = Book::factory()->make();

        $this->bookService->shouldReceive('createBook')
                          ->once()
                          ->with($request->all())
                          ->andReturn($book);

        $response = $this->bookController->store($request);

        $this->assertEquals(201, $response->status());
        $this->assertEquals($book->toArray(), $response->getData(true));
    }

    public function test_show_returns_book_by_id()
    {
        $book = Book::factory()->make(['id' => 1]);

        $this->bookService->shouldReceive('findBook')
                          ->once()
                          ->with(1)
                          ->andReturn($book);

        $response = $this->bookController->show(1);

        $this->assertEquals(200, $response->status());
        $this->assertEquals($book->toArray(), $response->getData(true));
    }

    public function test_update_modifies_existing_book()
    {
        $request = Request::create('/api/books/1', 'PUT', [
            'title' => 'Updated Book',
            'publication_year' => '2023',
            'author_id' => 2,
        ]);

        $book = Book::factory()->make(['id' => 1]);

        $this->bookService->shouldReceive('updateBook')
                          ->once()
                          ->with(1, $request->all())
                          ->andReturn($book);

        $response = $this->bookController->update($request, 1);

        $this->assertEquals(200, $response->status());
        $this->assertEquals($book->toArray(), $response->getData(true));
    }

    public function test_destroy_deletes_book()
    {
        $this->bookService->shouldReceive('deleteBook')
                          ->once()
                          ->with(1)
                          ->andReturn(true);

        $response = $this->bookController->destroy(1);

        $this->assertEquals(204, $response->status());
    }
}
