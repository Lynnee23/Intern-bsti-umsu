<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Book;

class BookController extends \Illuminate\Routing\Controller
{
    public function index(Request $request)
    {
        $search   = $request->input('search');
        $category = $request->input('category_id');
        $year     = $request->input('publication_year');

        $query = Book::with('category');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%");
            });
        }

        if ($category) {
            $query->where('category_id', $category);
        }

        if ($year) {
            $query->where('publication_year', $year);
        }

        $books      = $query->orderByDesc('id')->paginate(100)->withQueryString();
        $categories = \App\Models\Category::all();
        $years      = Book::select('publication_year as year')
                          ->distinct()
                          ->orderByDesc('year')
                          ->pluck('year');

        return view('books.index', compact('books', 'categories', 'years'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'publication_year' => 'required|digits:4|integer',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['category_id', 'title', 'author', 'publisher', 'publication_year', 'description']);

        if ($request->hasFile('cover_image')) {
            $data['cover_image_path'] = $request->file('cover_image')->storePublicly('covers', 's3');
        }

        Book::create($data);

        return redirect()->route('books.index')->with('success', 'Buku berhasil ditambahkan!');
    }

    public function show(string $id)
    {
        $book = Book::findOrFail($id);
        return view('books.detail', compact('book'));
    }

    public function edit(string $id)
    {
        $book = Book::findOrFail($id);
        $categories = Category::all();
        return view('books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, string $id)
    {
        $book = Book::findOrFail($id);

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'publication_year' => 'required|digits:4|integer',
            'description' => 'nullable|string',
            'cover_image' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['category_id', 'title', 'author', 'publisher', 'publication_year', 'description']);

        if ($request->hasFile('cover_image')) {
            // Hapus foto lama jika ada
            if ($book->cover_image_path) {
                Storage::disk('s3')->delete($book->cover_image_path);
            }
            $data['cover_image_path'] = $request->file('cover_image')->storePublicly('covers', 's3');
        }

        $book->update($data);

        return redirect()->route('books.index')->with('success', 'Buku berhasil diupdate!');
    }

    public function destroy(string $id)
    {
        $book = Book::findOrFail($id);

        if ($book->cover_image_path) {
            Storage::disk('s3')->delete($book->cover_image_path);
        }

        $book->delete();

        return redirect()->route('books.index')->with('success', 'Buku berhasil dihapus!');
    }
}
