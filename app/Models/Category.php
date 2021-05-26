<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // table
    protected $table = 'categories';
    // variable
    protected $fillable =
    [
        'title',
        'user_id',
        'created_at'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
