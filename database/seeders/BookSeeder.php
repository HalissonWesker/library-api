<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Author;

class BookSeeder extends Seeder
{
    public function run()
    {
        $books = [
            ['title' => 'Ação Humana', 'publication_year' => 1949, 'author_id' => Author::where('name', 'Ludwig von Mises')->first()->id],
            ['title' => 'O Homem, a Economia e o Estado', 'publication_year' => 1962, 'author_id' => Author::where('name', 'Murray Rothbard')->first()->id],
            ['title' => 'O Caminho da Servidão', 'publication_year' => 1944, 'author_id' => Author::where('name', 'Friedrich Hayek')->first()->id],
            ['title' => 'A Revolta de Atlas', 'publication_year' => 1957, 'author_id' => Author::where('name', 'Ayn Rand')->first()->id],
            ['title' => 'Capitalismo e Liberdade', 'publication_year' => 1962, 'author_id' => Author::where('name', 'Milton Friedman')->first()->id],
            ['title' => 'Economia Numa Única Lição', 'publication_year' => 1946, 'author_id' => Author::where('name', 'Henry Hazlitt')->first()->id],
            ['title' => 'Nosso Inimigo, o Estado', 'publication_year' => 1935, 'author_id' => Author::where('name', 'Albert Jay Nock')->first()->id],
            ['title' => 'O Deus da Máquina', 'publication_year' => 1943, 'author_id' => Author::where('name', 'Isabel Paterson')->first()->id],
            ['title' => 'A Descoberta da Liberdade', 'publication_year' => 1943, 'author_id' => Author::where('name', 'Rose Wilder Lane')->first()->id],
            ['title' => 'Anarquia, Estado e Utopia', 'publication_year' => 1974, 'author_id' => Author::where('name', 'Robert Nozick')->first()->id],
            ['title' => '1984', 'publication_year' => 1949, 'author_id' => Author::where('name', 'George Orwell')->first()->id],
            ['title' => 'Harry Potter e a Pedra Filosofal', 'publication_year' => 1997, 'author_id' => Author::where('name', 'J.K. Rowling')->first()->id],
            ['title' => 'O Hobbit', 'publication_year' => 1937, 'author_id' => Author::where('name', 'J.R.R. Tolkien')->first()->id],
            ['title' => 'O Sol é Para Todos', 'publication_year' => 1960, 'author_id' => Author::where('name', 'Harper Lee')->first()->id],
            ['title' => 'O Grande Gatsby', 'publication_year' => 1925, 'author_id' => Author::where('name', 'F. Scott Fitzgerald')->first()->id],
            ['title' => 'Orgulho e Preconceito', 'publication_year' => 1813, 'author_id' => Author::where('name', 'Jane Austen')->first()->id],
            ['title' => 'As Aventuras de Huckleberry Finn', 'publication_year' => 1884, 'author_id' => Author::where('name', 'Mark Twain')->first()->id],
            ['title' => 'O Velho e o Mar', 'publication_year' => 1952, 'author_id' => Author::where('name', 'Ernest Hemingway')->first()->id],
            ['title' => 'Guerra e Paz', 'publication_year' => 1869, 'author_id' => Author::where('name', 'Leo Tolstoy')->first()->id],
            ['title' => 'Cem Anos de Solidão', 'publication_year' => 1967, 'author_id' => Author::where('name', 'Gabriel García Márquez')->first()->id],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}
