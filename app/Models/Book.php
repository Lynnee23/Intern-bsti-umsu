<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Book extends Model
{
    protected $fillable = [
        'category_id',
        'title',
        'author',
        'publisher',
        'publication_year',
        'description',
        'cover_image_path'
    ];

    protected $appends = ['cover_image_url'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function getCoverImageUrlAttribute()
    {
        if (!$this->cover_image_path) {
            return null;
        }

        if (preg_match('/^https?:\/\//', $this->cover_image_path)) {
            return $this->cover_image_path;
        }

        if (str_starts_with($this->cover_image_path, 'cover_buku/') || str_starts_with($this->cover_image_path, 'public/cover_buku/')) {
            return asset($this->cover_image_path);
        }

        return Storage::disk('s3')->url($this->cover_image_path);
    }
}
