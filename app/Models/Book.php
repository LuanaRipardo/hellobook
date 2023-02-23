<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'name', 'gender', 'author', 'year', 'pages', 'language', 'isbn', 'publisher', 'reader_id'
    ];

    protected $casts = [
        'publisher' => 'array'
    ];

    public function reader()
    {
        return $this->belongsTo(Reader::class, 'reader_id');
    }
}




