@extends('layouts.app')

@section('title', $book->title . ' - Detail')

@section('content')
    <a href="{{ route('books.index') }}" class="back-link">← Kembali ke Daftar Buku</a>

    <div class="detail-card">
        @if($book->cover_image_url)
            <img src="{{ $book->cover_image_url }}" class="detail-cover" alt="{{ $book->title }}">
        @else
            <div class="detail-cover-placeholder">📖</div>
        @endif

        <div class="detail-info">
            <div class="book-category"
                style="font-size:0.75rem; color:#38bdf8; font-weight:600; text-transform:uppercase; letter-spacing:0.5px;">
                {{ $book->category->name ?? '-' }}
            </div>
            <h1>{{ $book->title }}</h1>

            <div class="detail-meta">
                <div class="detail-meta-item"><strong>Penulis</strong>: {{ $book->author }}</div>
                <div class="detail-meta-item"><strong>Penerbit</strong>: {{ $book->publisher }}</div>
                <div class="detail-meta-item"><strong>Tahun Terbit</strong>: {{ $book->publication_year }}</div>
            </div>

            @if($book->description)
                <div class="detail-description">{{ $book->description }}</div>
            @endif

            <div style="display:flex; gap:0.75rem; margin-top:1.5rem;">
                <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning">Edit Buku</a>
                <form action="{{ route('books.destroy', $book->id) }}" method="POST"
                    onsubmit="return confirm('Hapus buku ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Hapus Buku</button>
                </form>
            </div>
        </div>
    </div>
@endsection