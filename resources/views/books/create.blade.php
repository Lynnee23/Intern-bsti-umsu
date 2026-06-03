@extends('layouts.app')

@section('title', 'Tambah Buku')

@section('content')
    <a href="{{ route('books.index') }}" class="back-link">← Kembali ke Daftar Buku</a>

    <div class="page-header">
        <h1 class="page-title">Tambah Buku</h1>
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

        <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label class="form-label">Kategori</label>
                <select name="category_id" class="form-control">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Judul Buku</label>
                <input type="text" name="title" class="form-control"
                       value="{{ old('title') }}" placeholder="Masukkan judul buku">
            </div>

            <div class="form-group">
                <label class="form-label">Penulis</label>
                <input type="text" name="author" class="form-control"
                       value="{{ old('author') }}" placeholder="Nama penulis">
            </div>

            <div class="form-group">
                <label class="form-label">Penerbit</label>
                <input type="text" name="publisher" class="form-control"
                       value="{{ old('publisher') }}" placeholder="Nama penerbit">
            </div>

            <div class="form-group">
                <label class="form-label">Tahun Terbit</label>
                <input type="number" name="publication_year" class="form-control"
                       value="{{ old('publication_year') }}" placeholder="2024" min="1900" max="2099">
            </div>

            <div class="form-group">
                <label class="form-label">Deskripsi</label>
                <textarea name="description" class="form-control"
                          placeholder="Deskripsi singkat tentang buku...">{{ old('description') }}</textarea>
            </div>

            <div class="form-group">
                <label class="form-label">Cover Buku</label>
                <input type="file" name="cover_image" class="form-control" accept="image/*">
            </div>

            <div style="display:flex; gap:8px; margin-top:20px;">
                <button type="submit" class="btn btn-primary">Simpan Buku</button>
                <a href="{{ route('books.index') }}" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
@endsection