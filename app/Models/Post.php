<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // table
    protected $table = 'posts';
    // variable
    protected $fillable =
    [
        'user_id',
        'content',
        'embed',
        'created_at'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
