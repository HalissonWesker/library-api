<?php

namespace App\Services;

use App\Repositories\AuthorRepository;

class AuthorService
{
    protected $authorRepository;

    public function __construct(AuthorRepository $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    public function createAuthor(array $data)
    {
        return $this->authorRepository->create($data);
    }

    public function getAllAuthors()
    {
        return $this->authorRepository->getAll();
    }

    public function findAuthor($id)
    {
        return $this->authorRepository->find($id);
    }

    public function updateAuthor($id, array $data)
    {
        return $this->authorRepository->update($id, $data);
    }

    public function deleteAuthor($id)
    {
        return $this->authorRepository->delete($id);
    }
}
