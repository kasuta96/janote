<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class TrashController extends Controller
{
    public function pagination($rq, $query)
    {
        $data = new \stdClass();
        $data->page = $rq->input('p') ?? 1;
        $data->count = $query->count() ?? 0;
        $data->limit = 25;
        $data->totalPage = ceil($data->count/$data->limit);
        return $data;
    }

    public function index(Request $request)
    {
        // CATEGORIES
        $categories = Category::where('user_id',Auth::id())
        ->where('status',9)
        ->orderBy('id', 'DESC')
        ->get();
        // Count notes
        if (isset($categories[0])) {
            foreach ($categories as $key => $category) {
                $category->count = Note::where('category_id',$category->id)->count() ?? 0;
            }
        }
        // NOTE
        // page request
        $page = $request->input('p') ?? 1;
        // query
        $query = Note::with('category')
        ->where('user_id',Auth::id())
        ->where('status',9)
        ->orderBy('id', 'DESC');
        // pagination data
        $pagination = $this->pagination($request, $query);
        // notes data
        $notes = $query->skip($pagination->limit*($pagination->page - 1))
        ->take($pagination->limit)
        ->get();

        return view('trash', ['Notes'=>$notes, 'Categories'=>$categories, 'Data'=>$pagination]);
    }

}
