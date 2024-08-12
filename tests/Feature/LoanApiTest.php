<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Loan;
use App\Models\User;
use App\Models\Book;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LoanApiTest extends TestCase
{
    use DatabaseTransactions;

    public function test_loan_creation()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $user = User::factory()->create();
        $book = Book::factory()->create();

        $response = $this->actingAs($admin, 'api')->postJson('/api/loans/', [
            'user_id' => $user->id,
            'book_id' => $book->id,
            'borrow_date' => now()->format('Y-m-d'),
            'return_date' => now()->addDays(7)->format('Y-m-d'),
        ]);

        $response->assertStatus(201)
                ->assertJson([
                    'user_id' => $user->id,
                    'book_id' => $book->id,
                ]);
    }

    public function test_loan_listing()
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $loan = Loan::factory()->create();

        $response = $this->actingAs($admin, 'api')->getJson('/api/loans/');

        $response->assertStatus(200)
                 ->assertJsonFragment(['id' => $loan->id]);
    }

    public function test_loan_updating()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $loan = Loan::factory()->create();

        $response = $this->actingAs($admin, 'api')->putJson("/api/loans/{$loan->id}", [
            'return_date' => now()->addDays(14)->format('Y-m-d'),
        ]);

        $response->assertStatus(200)
                 ->assertJson(['return_date' => now()->addDays(14)->format('Y-m-d')]);
    }

    public function test_loan_deletion()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $loan = Loan::factory()->create();

        $response = $this->actingAs($admin, 'api')->deleteJson("/api/loans/{$loan->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('loans', ['id' => $loan->id]);
    }
}
