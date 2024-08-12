<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Loan;
use App\Services\LoanService;
use App\Http\Controllers\LoanController;
use Illuminate\Http\Request;
use Mockery;

class LoanControllerTest extends TestCase
{
    protected $loanService;
    protected $loanController;

    public function setUp(): void
    {
        parent::setUp();

        $this->loanService = Mockery::mock(LoanService::class);
        $this->loanController = new LoanController($this->loanService);
    }

    public function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_index_returns_all_loans()
    {
        $loans = Loan::factory()->count(3)->make();

        $this->loanService->shouldReceive('getAllLoans')
                          ->once()
                          ->andReturn($loans);

        $response = $this->loanController->index();

        $this->assertEquals(200, $response->status());
        $this->assertEquals($loans->toArray(), $response->getData(true));
    }

    public function test_store_creates_new_loan()
    {
        $request = Request::create('/api/loans', 'POST', [
            'user_id' => 1,
            'book_id' => 1,
            'borrow_date' => '2024-01-01',
        ]);

        $loan = Loan::factory()->make();

        $this->loanService->shouldReceive('createLoan')
                          ->once()
                          ->with($request->all())
                          ->andReturn($loan);

        $response = $this->loanController->store($request);

        $this->assertEquals(201, $response->status());
        $this->assertEquals($loan->toArray(), $response->getData(true));
    }

    public function test_show_returns_loan_by_id()
    {
        $loan = Loan::factory()->make(['id' => 1]);

        $this->loanService->shouldReceive('findLoan')
                          ->once()
                          ->with(1)
                          ->andReturn($loan);

        $response = $this->loanController->show(1);

        $this->assertEquals(200, $response->status());
        $this->assertEquals($loan->toArray(), $response->getData(true));
    }

    public function test_update_modifies_existing_loan()
    {
        $request = Request::create('/api/loans/1', 'PUT', [
            'return_date' => '2024-02-01',
        ]);

        $loan = Loan::factory()->make(['id' => 1]);

        $this->loanService->shouldReceive('updateLoan')
                          ->once()
                          ->with(1, $request->all())
                          ->andReturn($loan);

        $response = $this->loanController->update($request, 1);

        $this->assertEquals(200, $response->status());
        $this->assertEquals($loan->toArray(), $response->getData(true));
    }

    public function test_destroy_deletes_loan()
    {
        $this->loanService->shouldReceive('deleteLoan')
                          ->once()
                          ->with(1)
                          ->andReturn(true);

        $response = $this->loanController->destroy(1);

        $this->assertEquals(204, $response->status());
    }
}
