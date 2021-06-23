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
        'created_at',
        'status'
    ];


    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    // relationship
    public function notes()
    {
        return $this->hasMany('App\Models\Note');
    }

    // Category other
    public function getOtherAttribute()
    {
        return (object) array(
            "id" => "other",
            "title" => __("Other"),
            "status" => 0,
        );
    }
}
