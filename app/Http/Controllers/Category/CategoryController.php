<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;


class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function pagination($rq, $query)
    {
        $data = new \stdClass();
        $data->page = $rq->input('p') ?? 1;
        $data->count = $query->count() ?? 0;
        $data->limit = 10;
        $data->totalPage = ceil($data->count/$data->limit);
        return $data;
    }

    public function show(Request $request)
    {
        // page request
        // query
        $query = Category::where('user_id',Auth::id())
        ->where('status','=',0)
        ->orderBy('id', 'DESC');
        // pagination data
        $pagination = $this->pagination($request, $query);
        // notes data
        $categories = $query->skip($pagination->limit*($pagination->page - 1))
        ->take($pagination->limit)
        ->get();

        return view('category.lists', compact('categories', 'pagination'));
    }

    public function store()
    {
        $data = request()->validate([
            'title' => 'required',
        ]);

        auth()->user()->categories()->create([
            'title' => $data['title'],
        ]);

        return redirect(route('categories'));
    }

    public function create()
    {
        return view('category/create');
    }

    public function delete($id)
    {
        $categories = Category::find($id);
        if (empty($categories)) {
            return redirect()->route('categories')->with('error', 'データがありません！');
        }
        if ($categories->user_id != Auth::user()->id) {
            return redirect()->route('categories')->with('error', '削除できません');
        }
        try {
            Category::destroy($id);
        } catch (\Throwable $th) {
            throw $th;
        }
        return redirect()->route('categories')->with('status', '削除しました');
    }

    public function edit($id)
    {
        $categories = Category::find($id);
        if ($categories->user_id != Auth::user()->id) {
            return redirect()->route('categories')->with('error', '編集できません');
        }
        return view('category/edit', compact('categories'));
    }

    public function update(Request $request, $id) 
    {
        $data = $request->validate([
            'title' => 'required',
        ]);

        $categories = Category::where('id',$id)->update([
            'title' => $data['title'],
        ]);

        return redirect(route('categories'));
    }

    // get categories raw data
    public static function CategoriesData()
    {
        $categories = Category::where('status', 0)
        ->where('user_id',Auth::id())
        ->orderBy('updated_at', 'desc')
        ->get();
        return $categories;
    }

}
