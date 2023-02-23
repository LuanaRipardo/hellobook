<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Reader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;

class ReaderController extends Controller
{
    public function index()
    {
        return Reader::all();
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:readers|max:255',
            'password' => 'required|string|min:8',
            'birthdate' => 'required|date_format:Y-m-d',
            'is_blocked' => 'boolean'
        ]);

        $reader = Reader::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'birthdate' => $validatedData['birthdate'],
            'is_blocked' => $validatedData['is_blocked']
        ]);

        return response()->json($reader, 201);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:readers,email,' . $id,
            'birthdate' => 'required|date_format:Y-m-d'
        ]);

        $reader = Reader::findOrFail($id);

        $reader->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'birthdate' => $validatedData['birthdate']
        ]);

        return response()->json([
            'message' => 'Leitor atualizado com sucesso',
            'reader' => $reader
        ], 200);
    }

    public function addBookToReader(Request $request, $readerId, $bookId)
    {
        $reader = Reader::findOrFail($readerId);
        $book = Book::findOrFail($bookId);

        if ($reader->books->contains($book)) {
            return response()->json([
                'message' => 'Livro já adicionado',
            ], 400);
        }

        $reader->books()->attach($book);
        $count = Cache::increment("reader.{$reader->id}.books.count");

        return response()->json([
            'message' => 'Livro adicionado com sucesso',
            'reader_name' => $reader->name,
            'name' => $book->title,
            'books_count' => $count,
        ], 200);
    }

    public function removeBookFromReader($readerId, $bookId)
    {
}


}
