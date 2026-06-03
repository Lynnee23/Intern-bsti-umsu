@extends('layouts.app')

@section('title', 'Daftar Buku')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Daftar Buku</h1>
        <a href="{{ route('books.create') }}" class="btn btn-primary">+ Tambah Buku</a>
    </div>

    {{-- Form Search & Filter --}}
    <form action="{{ route('books.index') }}" method="GET" class="search-filter-form">
        <input
            type="text"
            name="search"
            class="form-control"
            placeholder="Cari judul atau penulis..."
            value="{{ request('search') }}"
        >

        <select name="category_id" class="form-control">
            <option value="">-- Semua Kategori --</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>

        <select name="publication_year" class="form-control">
            <option value="">-- Semua Tahun --</option>
            @foreach($years as $year)
                <option value="{{ $year }}" {{ request('publication_year') == $year ? 'selected' : '' }}>
                    {{ $year }}
                </option>
            @endforeach
        </select>

        <button type="submit" class="btn btn-primary">Cari</button>

        @if(request('search') || request('category_id') || request('publication_year'))
            <a href="{{ route('books.index') }}" class="btn btn-secondary">Reset</a>
        @endif
    </form>



    @if($books->isEmpty())
        <div class="empty-state">
            <div class="empty-state-icon">📭</div>
            <p>Tidak ada buku yang ditemukan.</p>
            <a href="{{ route('books.index') }}" class="btn btn-secondary">Tampilkan Semua</a>
        </div>
    @else
        <div class="book-grid">
            @foreach($books as $book)
                <div class="book-card">
                    @if($book->cover_image_url)
                        <img src="{{ $book->cover_image_url }}"
                             class="book-cover" alt="{{ $book->title }}">
                    @else
                        <div class="book-cover-placeholder">📖</div>
                    @endif

                    <div class="book-body">
                        <div class="book-category">{{ $book->category->name ?? '-' }}</div>
                        <div class="book-title">{{ $book->title }}</div>
                        <div class="book-author">{{ $book->author }} · {{ $book->publication_year }}</div>

                        <div class="book-actions">
                            <a href="{{ route('books.show', $book->id) }}" class="btn btn-secondary">Detail</a>
                            <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('books.destroy', $book->id) }}" method="POST"
                                  onsubmit="return confirm('Hapus buku ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}

    @endif
@endsection