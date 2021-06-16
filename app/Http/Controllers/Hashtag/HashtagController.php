<?php

namespace App\Http\Controllers\Hashtag;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Note;
use Illuminate\Support\Facades\Auth;


class HashtagController extends Controller
{
    public function show()
    {
        return view('hashtag.lists');
    }
}
?>