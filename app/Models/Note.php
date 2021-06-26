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
        'status',
        'hashtag',
        'mark'
    ];

    // relationship
    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
