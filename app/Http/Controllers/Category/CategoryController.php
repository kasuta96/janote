<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    //
    public function show()
    {
        $categories = Category::all();

        return view('category.lists',['categories'=>$categories]);
    }

    /*public function create()
    {
        return view('category/create');
    }*/

}
