<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Reader;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return response()->json($books);
    }


    public function store(Request $request)
{
    $book = new Book;
    $book->name = $request->name;
    $book->author = $request->author;
    $book->gender = $request->gender;
    $book->year = $request->year;
    $book->pages = $request->pages;
    $book->language = $request->language;
    $book->isbn = $request->isbn;
    $book->publisher = $request->publisher;
    $book->save();
    return response()->json(['message' => 'Livro adicionado com sucesso!']);
}

public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'name' => 'required|max:255',
        'author' => 'required|max:255',
        'gender' => 'required|max:255',
        'year' => 'required|integer',
        'pages' => 'required|integer',
        'language' => 'required|max:255',
        'isbn' => 'required|max:255',
        'publisher' => 'required|max:255',
    ]);

    $book = Book::find($id);
    if (!$book) {
        return response()->json(['error' => 'Livro não encontrado'], 404);
    }

    $book->update($validatedData);

    return response()->json(['message' => 'Livro atualizado com sucesso!']);
}


public function deleteBook($book_id)
{
    $book = Book::find($book_id);

    if (!$book) {
        return response()->json(['error' => 'Livro não encontrado'], 404);
    }

    $book->delete();

    return response()->json(['message' => 'Livro excluído com sucesso']);
}




public function addToReader($reader_id, Request $request)
{
    $validatedData = $request->validate([
        'book_id' => 'required|exists:books,id'
    ]);

    $reader = Reader::find($reader_id);

    if (!$reader) {
        return response()->json(['error' => 'Leitor não encontrado'], 404);
    }

    $book = Book::find($validatedData['book_id']);

    if (!$book) {
        return response()->json(['error' => 'Livro não encontrado'], 404);
    }

    if ($reader->books()->where('book_id', $book->id)->exists()) {
        return response()->json(['error' => 'Livro já está associado a este leitor'], 409);
    }

    $reader->books()->attach($book->id);

    return response()->json(['message' => 'Livro adicionado ao perfil do leitor']);
}

}
