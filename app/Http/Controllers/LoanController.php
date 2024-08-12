<?php

namespace App\Http\Controllers;

use App\Services\LoanService;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    protected $loanService;

    public function __construct(LoanService $loanService)
    {
        $this->loanService = $loanService;
    }

    public function index()
    {
        return response()->json($this->loanService->getAllLoans());
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'book_id' => 'required|exists:books,id',
            'borrow_date' => 'required|date',
            'return_date' => 'required|date',
        ]);

        return response()->json($this->loanService->createLoan($validatedData), 201);
    }

    public function show($id)
    {
        return response()->json($this->loanService->findLoan($id));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'return_date' => 'sometimes|required|date',
        ]);

        return response()->json($this->loanService->updateLoan($id, $validatedData));
    }

    public function destroy($id)
    {
        $this->loanService->deleteLoan($id);
        return response()->json(null, 204);
    }
}
