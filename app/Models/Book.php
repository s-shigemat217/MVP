<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'author',
        'publisher',
        'published_date',
        'status',
        'isbn',
        'source',
        'source_id',
        'cover_image_url',
    ];
}
