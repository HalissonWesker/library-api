<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Author;
use App\Services\AuthorService;
use App\Http\Controllers\AuthorController;
use Illuminate\Http\Request;
use Mockery;

class AuthorControllerTest extends TestCase
{
    protected $authorService;
    protected $authorController;

    public function setUp(): void
    {
        parent::setUp();

        // Cria um mock do serviço AuthorService
        $this->authorService = Mockery::mock(AuthorService::class);

        // Injeta o mock no controlador
        $this->authorController = new AuthorController($this->authorService);
    }

    public function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_index_returns_all_authors()
    {
        $authors = Author::factory()->count(3)->make();

        // Define o comportamento esperado do serviço
        $this->authorService->shouldReceive('getAllAuthors')
                            ->once()
                            ->andReturn($authors);

        // Chama o método index e verifica a resposta
        $response = $this->authorController->index();

        $this->assertEquals(200, $response->status());
        $this->assertEquals($authors->toArray(), $response->getData(true));
    }

    public function test_store_creates_new_author()
    {
        $request = Request::create('/api/authors', 'POST', [
            'name' => 'Test Author',
            'birth_date' => '1970-01-01',
        ]);

        $author = Author::factory()->make();

        // Define o comportamento esperado do serviço
        $this->authorService->shouldReceive('createAuthor')
                            ->once()
                            ->with($request->all())
                            ->andReturn($author);

        // Chama o método store e verifica a resposta
        $response = $this->authorController->store($request);

        $this->assertEquals(201, $response->status());
        $this->assertEquals($author->toArray(), $response->getData(true));
    }

    public function test_show_returns_author_by_id()
    {
        $author = Author::factory()->make(['id' => 1]);

        // Define o comportamento esperado do serviço
        $this->authorService->shouldReceive('findAuthor')
                            ->once()
                            ->with(1)
                            ->andReturn($author);

        // Chama o método show e verifica a resposta
        $response = $this->authorController->show(1);

        $this->assertEquals(200, $response->status());
        $this->assertEquals($author->toArray(), $response->getData(true));
    }

    public function test_update_modifies_existing_author()
    {
        $request = Request::create('/api/authors/1', 'PUT', [
            'name' => 'Updated Author',
            'birth_date' => '1971-01-01',
        ]);

        $author = Author::factory()->make(['id' => 1]);

        // Define o comportamento esperado do serviço
        $this->authorService->shouldReceive('updateAuthor')
                            ->once()
                            ->with(1, $request->all())
                            ->andReturn($author);

        // Chama o método update e verifica a resposta
        $response = $this->authorController->update($request, 1);

        $this->assertEquals(200, $response->status());
        $this->assertEquals($author->toArray(), $response->getData(true));
    }

    public function test_destroy_deletes_author()
    {
        // Define o comportamento esperado do serviço
        $this->authorService->shouldReceive('deleteAuthor')
                            ->once()
                            ->with(1)
                            ->andReturn(true);

        // Chama o método destroy e verifica a resposta
        $response = $this->authorController->destroy(1);

        $this->assertEquals(204, $response->status());
    }
}
