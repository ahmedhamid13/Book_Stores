<?php

namespace App\Http\Controllers;

use App\Book;
use App\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(){
        $books = Book::all();
        return view('books.index', ['books' => $books]);
    }

    public function show($id){
        $book = Book::find($id);
        return view('books.show', ['book' => $book]);
    }

    public function create(){
        $categories = Category::all();
        return view('books.create', ['categories' => $categories]);
    }

    public function store(){
        $book = Book::create([
            'title' => request('title'),
            'description' => request('description'),
            'author' => request('author'),
            'released_at' => request('released_at'),
            'price' => request('price'),
            'category_id' => request('category')
        ]);
        return redirect()->route('books.show', $book->id)->with(['success' => 'created successfully!']);
    }

    public function edit($id){
        $book = Book::find($id);
        $categories = Category::all();
        return view('books.edit', ['book' => $book, 'categories' => $categories]);
    }

    public function update($id){
        Book::find($id)->update([
            'title' => request('title'),
            'description' => request('description'),
            'author' => request('author'),
            'released_at' => request('released_at'),
            'price' => request('price'),
            'category_id' => request('category')
        ]);
        return redirect()->route('books.index')->with('success', 'updated successfully!');
    }

    public function destroy(){
        $book = Book::find($id);
        return redirect()->route('books.index')->with('success', 'deleted successfully!');
    }
}
