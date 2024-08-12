<?php

namespace App\Repositories;

use App\Models\Author;

class AuthorRepository
{
    public function getAll()
    {
        return Author::all();
    }

    public function find($id)
    {
        return Author::findOrFail($id);
    }

    public function create(array $data)
    {
        return Author::create($data);
    }

    public function update($id, array $data)
    {
        $author = $this->find($id);
        $author->update($data);
        return $author;
    }

    public function delete($id)
    {
        $author = $this->find($id);
        return $author->delete();
    }
}
