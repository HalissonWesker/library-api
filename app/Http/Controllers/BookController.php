<?php

namespace App\Http\Controllers;

use App\Services\BookService;
use Illuminate\Http\Request;
use Carbon\Carbon; 

class BookController extends Controller
{
    protected $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    public function index()
    {
        return response()->json($this->bookService->getAllBooks());
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'publication_year' => 'required|integer|max:' . Carbon::now()->year,
            'author_id' => 'required|exists:authors,id',
        ]);

        return response()->json($this->bookService->createBook($validatedData), 201);
    }

    public function show($id)
    {
        return response()->json($this->bookService->findBook($id));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'publication_year' => 'sometimes|required|integer',
            'author_id' => 'sometimes|required|exists:authors,id',
        ]);

        return response()->json($this->bookService->updateBook($id, $validatedData));
    }

    public function destroy($id)
    {
        $this->bookService->deleteBook($id);
        return response()->json(null, 204);
    }

    public function search(Request $request)
    {
        $validatedData = $request->validate([
            'query' => 'required|string|max:255'
        ]);

        $books = $this->bookService->searchBooksByTitle($validatedData['query']);
        return response()->json($books);
    }
}
