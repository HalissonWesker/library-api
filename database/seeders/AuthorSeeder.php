<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author;

class AuthorSeeder extends Seeder
{
    public function run()
    {
        $authors = [
            ['name' => 'Ludwig von Mises', 'birth_date' => '1881-09-29'],
            ['name' => 'Murray Rothbard', 'birth_date' => '1926-03-02'],
            ['name' => 'Friedrich Hayek', 'birth_date' => '1899-05-08'],
            ['name' => 'Ayn Rand', 'birth_date' => '1905-02-02'],
            ['name' => 'Milton Friedman', 'birth_date' => '1912-07-31'],
            ['name' => 'Henry Hazlitt', 'birth_date' => '1894-11-28'],
            ['name' => 'Albert Jay Nock', 'birth_date' => '1870-10-13'],
            ['name' => 'Isabel Paterson', 'birth_date' => '1886-01-22'],
            ['name' => 'Rose Wilder Lane', 'birth_date' => '1886-12-05'],
            ['name' => 'Robert Nozick', 'birth_date' => '1938-11-16'],
            ['name' => 'George Orwell', 'birth_date' => '1903-06-25'],
            ['name' => 'J.K. Rowling', 'birth_date' => '1965-07-31'],
            ['name' => 'J.R.R. Tolkien', 'birth_date' => '1892-01-03'],
            ['name' => 'Harper Lee', 'birth_date' => '1926-04-28'],
            ['name' => 'F. Scott Fitzgerald', 'birth_date' => '1896-09-24'],
            ['name' => 'Jane Austen', 'birth_date' => '1775-12-16'],
            ['name' => 'Mark Twain', 'birth_date' => '1835-11-30'],
            ['name' => 'Ernest Hemingway', 'birth_date' => '1899-07-21'],
            ['name' => 'Leo Tolstoy', 'birth_date' => '1828-09-09'],
            ['name' => 'Gabriel García Márquez', 'birth_date' => '1927-03-06'],
            ['name' => 'Author Name', 'birth_date' => '1970-01-01'],
        ];

        foreach ($authors as $author) {
            Author::create($author);
        }
    }
}
