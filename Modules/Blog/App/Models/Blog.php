<?php

namespace Modules\Blog\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Blog\Database\Factories\BlogFactory;

// use Modules\Blog\Database\factories\BlogFactory;

class Blog extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['title', 'detail', 'author',];

    protected static function newFactory(): BlogFactory
    {
        return BlogFactory::new();
    }
}
