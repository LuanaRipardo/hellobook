<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $books = [
            [
                'name' => 'The Great Gatsby',
                'author' => 'F. Scott Fitzgerald',
                'gender' => 'Novel',
                'year' => 1925,
                'pages' => 218,
                'language' => 'English',
                'isbn' => '9780743273565',
                'publisher' => '{"name":"Charles Scribner\'s Sons","code":"CS000","telephone":"555-555-5555"}',
            ],
            [
                'name' => 'To Kill a Mockingbird',
                'author' => 'Harper Lee',
                'gender' => 'Novel',
                'year' => 1960,
                'pages' => 281,
                'language' => 'English',
                'isbn' => '9780446310789',
                'publisher' => '{"name":"J. B. Lippincott & Co.","code":"JBL000","telephone":"555-555-5555"}',
            ],
            [
                'name' => 'Pride and Prejudice',
                'author' => 'Jane Austen',
                'gender' => 'Novel',
                'year' => 1813,
                'pages' => 279,
                'language' => 'English',
                'isbn' => '9780140390533',
                'publisher' => '{"name":"Thomas Egerton","code":"TE000","telephone":"555-555-5555"}',
            ],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}
