@extends('layouts.app')

@section('title', 'Edit Buku')

@section('content')
    <a href="{{ route('books.index') }}" class="back-link">← Kembali ke Daftar Buku</a>

    <div class="page-header">
        <h1 class="page-title">Edit Buku</h1>
    </div>

    <div class="form-card">
        @if($errors->any())
            <div class="alert-error">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label class="form-label">Kategori</label>
                <select name="category_id" class="form-control">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}"
                            {{ old('category_id', $book->category_id) == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Judul Buku</label>
                <input type="text" name="title" class="form-control"
                       value="{{ old('title', $book->title) }}" placeholder="Masukkan judul buku">
            </div>

            <div class="form-group">
                <label class="form-label">Penulis</label>
                <input type="text" name="author" class="form-control"
                       value="{{ old('author', $book->author) }}" placeholder="Nama penulis">
            </div>

            <div class="form-group">
                <label class="form-label">Penerbit</label>
                <input type="text" name="publisher" class="form-control"
                       value="{{ old('publisher', $book->publisher) }}" placeholder="Nama penerbit">
            </div>

            <div class="form-group">
                <label class="form-label">Tahun Terbit</label>
                <input type="number" name="publication_year" class="form-control"
                       value="{{ old('publication_year', $book->publication_year) }}"
                       min="1900" max="2099">
            </div>

            <div class="form-group">
                <label class="form-label">Deskripsi</label>
                <textarea name="description" class="form-control">{{ old('description', $book->description) }}</textarea>
            </div>

            <div class="form-group">
                <label class="form-label">Cover Buku</label>
                @if($book->cover_image_url)
                    <img src="{{ $book->cover_image_url }}"
                         style="height:80px; border-radius:4px; display:block; margin-bottom:8px;">
                    <small style="color:#64748b;">Pilih file baru untuk mengganti cover</small><br><br>
                @endif
                <input type="file" name="cover_image" class="form-control" accept="image/*">
            </div>

            <div style="display:flex; gap:0.75rem; margin-top:1.5rem;">
                <button type="submit" class="btn btn-primary">Update Buku</button>
                <a href="{{ route('books.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
@endsection