<?php

namespace App\Http\Controllers\Note;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Note;
use App\Models\Category;

class NoteController extends Controller
{
    //
    public function index($id, Request $request)
    {
        // page request
        $page = $request->input('p') ?? 1;
        // notes data
        $notes = Note::where('category_id','=',$id)
        ->orderBy('id', 'DESC') // sắp xếp theo id thứ tự mới nhất
        ->skip(25*($page - 1)) // số row bỏ qua (vd: page = 1: bắt đầu lấy từ 0, page = 2: lấy từ 25*(2-1)=25)
        ->take(25) // lấy 25 row
        ->get();
        // get category's name by id
        // $category = Category::find($notes->category_id)->title;

        // dd($notes);
        return view('note.list', ['Notes'=>$notes]);
    }
}
