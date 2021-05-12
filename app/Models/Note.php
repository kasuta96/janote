<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    // table
    protected $table = 'notes';
    // variable
    protected $fillable =
    [
        'title',
        'content',
        'user_id',
        'category_id',
        'audio',
        'image',
        'created_at'
    ];
}
