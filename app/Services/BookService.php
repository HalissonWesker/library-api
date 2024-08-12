<?php

namespace App\Services;

use App\Repositories\BookRepository;

class BookService
{
    protected $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function createBook(array $data)
    {
        return $this->bookRepository->create($data);
    }

    public function getAllBooks()
    {
        return $this->bookRepository->getAll();
    }

    public function findBook($id)
    {
        return $this->bookRepository->find($id);
    }

    public function updateBook($id, array $data)
    {
        return $this->bookRepository->update($id, $data);
    }

    public function deleteBook($id)
    {
        return $this->bookRepository->delete($id);
    }

    public function searchBooksByTitle($term)
    {
        return $this->bookRepository->searchByTitle($term);
    }
}
