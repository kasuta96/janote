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

    public function create(Request $request)
{
    $input = $request->all();
    if (Auth::check()) // if login
    {
        if ($input['content']) {
            $input['user_id'] = Auth::id();
            Post::create($input);
            return redirect()->route('posts')->with('status', 'push success!');;
        }
        else // with('status', '質問を編集しました')
        {
            return redirect()->route('posts')->with('error', 'Input data first!');
        }
    }
    else // if not login
    {
        return redirect()->route('login');
    }

}
}
