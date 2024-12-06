<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use App\Models\InventoryDetail;
use App\Models\InventoryType;
use App\Models\PriceRange;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::paginate(4);
        return view('book.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genres = Genre::all();
        $price_ranges = PriceRange::all();
        $format_types = InventoryType::all();
        $authors = Author::all();
        return view('book.create', compact('genres','price_ranges','format_types','authors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'book_title' => 'required',
            'author_name' => 'required',
            'genre' => 'required',
            'price_range' => 'required',
            'isbn' => 'required|unique:books,isbn',
            'format_type.*' => 'required',
            'num_of_copies.*' => 'required',
            'prices.*' => 'required'
        ]);
        
        $data = $request->all();

        $author = Author::where('author_name', $data['author_name'])->first();
        if(!$author) {
            $author = Author::create(['author_name' => $data['author_name']]);
        }

        $book = Book::create([
            'book_title' => $data['book_title'],
            'author_id' => $author->id,
            'genre_id' => $data['genre'],
            'price_id' => $data['price_range'],
            'isbn' => $data['isbn'],
        ]);

        foreach($data['format_type'] as $k => $format_type){
            InventoryDetail::create([
                'book_id' => $book->id,
                'format_id' => $format_type,
                'num_of_copies' => $data['num_of_copies'][$k], 
                'price_id' => $data['prices'][$k], 
            ]);
        }

        return redirect()->to('/book');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        $genres = Genre::all();
        $price_ranges = PriceRange::all();
        $format_types = InventoryType::all();
        $authors = Author::all();
        return view('book.edit',compact('genres','price_ranges','format_types','authors','book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $data = $request->all();
        $request->validate([
            'book_title' => 'required',
            'author_name' => 'required',
            'genre' => 'required',
            'price_range' => 'required',
            'isbn' => ['required',Rule::unique('books')->ignore($book->id)],
            'format_type.*' => 'required',
            'num_of_copies.*' => 'required',
            'prices.*' => 'required'
        ]);

        $author = Author::where('author_name', $data['author_name'])->first();
        if(!$author) {
            $author = Author::create(['author_name' => $data['author_name']]);
        }

        $book->book_title = $data['book_title'];
        $book->author_id = $author->id;
        $book->genre_id = $data['genre'];
        $book->price_id = $data['price_range'];        
        $book->isbn = $data['isbn'];
        $book->save();

        InventoryDetail::where('book_id',$book->id)->delete();

        foreach($data['format_type'] as $k => $format_type){
            // $InventoryDetail = InventoryDetail::where('book_id',$book->id)->where('format_id')
            InventoryDetail::create([
                'book_id' => $book->id,
                'format_id' => $format_type,
                'num_of_copies' => $data['num_of_copies'][$k], 
                'price_id' => $data['prices'][$k], 
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->to('/book');
    }
}
