<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Author;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthorApiTest extends TestCase
{
    use DatabaseTransactions;

    public function test_author_creation()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $response = $this->actingAs($admin, 'api')->postJson('/api/authors', [
            'name' => 'New Author',
            'birth_date' => '1970-01-01',
        ]);

        $response->assertStatus(201)
                ->assertJson(['name' => 'New Author']);
    }


    public function test_author_listing()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $author = Author::factory()->create(['name' => 'Listed Author']);

        $response = $this->actingAs($admin, 'api')->getJson('/api/authors');

        $response->assertStatus(200)
                 ->assertJsonFragment(['name' => 'Listed Author']);
    }

    public function test_author_updating()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $author = Author::factory()->create(['name' => 'Old Author']);

        $response = $this->actingAs($admin, 'api')->putJson("/api/authors/{$author->id}", [
            'name' => 'Updated Author',
        ]);

        $response->assertStatus(200)
                 ->assertJson(['name' => 'Updated Author']);
    }

    public function test_author_deletion()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $author = Author::factory()->create(['name' => 'Author to Delete']);

        $response = $this->actingAs($admin, 'api')->deleteJson("/api/authors/{$author->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('authors', ['id' => $author->id]);
    }
}
