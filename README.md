# CRUD Buku - Laravel S3

Aplikasi CRUD Buku sederhana berbasis Laravel 11 dengan integrasi penyimpanan sampul buku ke cloud storage S3/MinIO.

## Fitur
- CRUD Buku (Tambah, Lihat, Edit, Hapus)
- Upload Cover Buku ke S3/MinIO
- Pencarian & Filter (Kategori & Tahun Terbit)

---

## 🔄 Alur Kerja Project (Project Flow)

Berikut adalah alur bagaimana data dan file diproses di dalam aplikasi ini:

### 1. Alur Tambah Buku (Create)
- **Input Form**: User mengisi form tambah buku dan mengunggah gambar sampul (`cover_image`).
- **Validasi**: Input divalidasi oleh `BookController`.
- **Upload S3**: Gambar sampul diunggah ke S3/MinIO secara publik menggunakan method `storePublicly('covers', 's3')`. Hasilnya berupa path file (misal: `covers/xyz123.jpg`).
- **Simpan DB**: Data buku beserta path file sampul disimpan ke tabel `books` di database MySQL.

### 2. Alur Tampil Buku (Read)
- **Mengambil Data**: Controller mengambil data buku beserta relasi kategorinya dari database.
- **Konversi URL Sampul**: Di dalam Model `Book.php`, terdapat accessor `cover_image_url` yang otomatis mendeteksi path file:
  - Jika berawalan `http://` atau `https://`, langsung menggunakan link tersebut.
  - Jika merupakan path lokal, menggunakan `asset()`.
  - Jika path dari S3, diubah menjadi URL permanen publik menggunakan `Storage::disk('s3')->url($path)`.
- **Tampilan**: Blade template merender data buku dan menampilkan gambar sampul menggunakan URL permanen tersebut.

### 3. Alur Edit Buku (Update)
- **Ganti Gambar Sampul (Opsional)**: Jika user mengunggah gambar sampul baru saat mengedit:
  - Gambar sampul lama yang ada di S3 akan **dihapus** menggunakan `Storage::disk('s3')->delete()`.
  - Gambar sampul baru diunggah ke S3 menggunakan `storePublicly()`.
- **Update DB**: Informasi buku terupdate disimpan kembali ke database.

### 4. Alur Hapus Buku (Delete)
- **Hapus Berkas S3**: Sebelum data buku dihapus dari database, aplikasi akan menghapus file sampul buku yang ada di S3 menggunakan `Storage::disk('s3')->delete()`.
- **Hapus DB**: Baris data buku dihapus dari database MySQL.
