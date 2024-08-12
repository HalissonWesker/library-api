<?php
namespace App\Repositories;

use App\Models\Book;

class BookRepository
{
    public function getAll()
    {
        return Book::with('author')->get();
    }

    public function find($id)
    {
        return Book::with('author')->findOrFail($id);
    }

    public function create(array $data)
    {
        return Book::create($data);
    }

    public function update($id, array $data)
    {
        $book = $this->find($id);
        $book->update($data);
        return $book;
    }

    public function delete($id)
    {
        $book = $this->find($id);
        return $book->delete();
    }

    public function searchByTitle($term)
    {
        $normalizedTerm = strtolower(preg_replace('/[^a-zA-Z0-9\s]/', '', $term));

        return Book::whereRaw(
            'LOWER(REGEXP_REPLACE(title, "[^a-zA-Z0-9\s]", "")) LIKE ?',
            ["%{$normalizedTerm}%"]
        )->with('author')->get();
    }
}
