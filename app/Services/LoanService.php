<?php

namespace App\Services;

use App\Repositories\LoanRepository;
use Illuminate\Support\Facades\Event;
use App\Events\LoanCreated;

class LoanService
{
    protected $loanRepository;

    public function __construct(LoanRepository $loanRepository)
    {
        $this->loanRepository = $loanRepository;
    }

    public function createLoan(array $data)
    {
        $loan = $this->loanRepository->create($data);
        
        Event::dispatch(new LoanCreated($loan)); //Notificações: Enviar um email ao usuário quando um livro for emprestado.

        return $loan;
    }

    public function getAllLoans()
    {
        return $this->loanRepository->getAll();
    }

    public function findLoan($id)
    {
        return $this->loanRepository->find($id);
    }

    public function updateLoan($id, array $data)
    {
        return $this->loanRepository->update($id, $data);
    }

    public function deleteLoan($id)
    {
        return $this->loanRepository->delete($id);
    }
}
