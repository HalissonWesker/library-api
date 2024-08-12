<?php

namespace App\Repositories;

use App\Models\Loan;

class LoanRepository
{
    public function getAll()
    {
        return Loan::with(['user', 'book'])->get();
    }

    public function find($id)
    {
        return Loan::with(['user', 'book'])->findOrFail($id);
    }

    public function create(array $data)
    {
        return Loan::create($data);
    }

    public function update($id, array $data)
    {
        $loan = $this->find($id);
        $loan->update($data);
        return $loan;
    }

    public function delete($id)
    {
        $loan = $this->find($id);
        return $loan->delete();
    }
}
