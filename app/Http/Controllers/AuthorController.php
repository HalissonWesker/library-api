<?php

namespace App\Http\Controllers;

use App\Services\AuthorService;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    protected $authorService;

    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }

    public function index()
    {
        return response()->json($this->authorService->getAllAuthors());
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'birth_date' => 'required|date',
        ]);

        return response()->json($this->authorService->createAuthor($validatedData), 201);
    }

    public function show($id)
    {
        return response()->json($this->authorService->findAuthor($id));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'birth_date' => 'sometimes|required|date',
        ]);

        return response()->json($this->authorService->updateAuthor($id, $validatedData));
    }

    public function destroy($id)
    {
        $this->authorService->deleteAuthor($id);
        return response()->json(null, 204);
    }
}
