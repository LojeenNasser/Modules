<?php

namespace Modules\Book\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Book\Database\factories\BookFactory;

class Book extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    use HasFactory;

    protected $table = 'books';

    protected $fillable = [
        'book_name',
        'price',
        'author',
        'description',
    ];

    protected static function newFactory(): BookFactory
    {
        return BookFactory::new();
    }
}
