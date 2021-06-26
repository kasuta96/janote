<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Note;
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
        if (isset($categories[0])) {
            foreach ($categories as $key => $category) {
                $category->count = Note::where('category_id',$category->id)->count() ?? 0;
            }
        }

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
    
    public function delete($id)
    {
        $categories = Category::find($id);
        if (empty($categories)) 
        {
            return redirect()->route('categories')->with('error', __('There is no data').'!');
        }
        if ($categories->user_id != Auth::user()->id) {
            return redirect()->route('categories')->with('error', __('This action is unauthorized.'));
        }
        try 
        {
            $categories->fill([
                'status' => 9,
            ]);
            $categories->save();

            $deleteNotes = Note::where('category_id', $id)->update(['status' => 8]);
            // Category::destroy($id);
        } catch (\Throwable $th) {
            throw $th;
        }
        return redirect()->route('categories')->with('status', __('Moved to trash'));
    }

    public function restore($rq)
    {
        // get note data
        if ($rq == 'all')
        {
            $categories = Category::where('status','=',9)
            ->where('user_id','=',Auth::id())
            ->get();
            // check data
            if (count($categories) == 0) {
                return redirect()->route('trash')->with('error', __('There is no data').'!');
            }
        }
        else
        {
            $categories = Category::find($rq);
            // check data
            if (empty($categories)) {
                return redirect()->route('trash')->with('error', __('There is no data').'!');
            }
            if ($categories->user_id != Auth::id())
            {
                return redirect()->route('trash')->with('error', __('This action is unauthorized.'));
            }
            // $categoriess = [$categories];
        }
            // Change status (0: active, 9: deleted)
        $categories->fill([
            'status' => 0,
        ]);
        $categories->save();
        Note::where('category_id', $rq)->update(['status' => 0]);
        return redirect()->route('trash')->with('status', __('Restored'));
    }

    public function remove($rq)
    {
        // get note data
        if ($rq == 'all')
        {
            $categories = Category::where('status','=',9)
            ->where('user_id','=',Auth::id())
            ->get();
            // check data
            if (count($categories) == 0) {
                return redirect()->route('trash')->with('error', __('There is no data').'!');
            }
        }
        else
        {
            $categories = Category::find($rq);
            // check data
            if (empty($categories)) {
                return redirect()->route('trash')->with('error', __('There is no data').'!');
            }
            if ($categories->user_id != Auth::id())
            {
                return redirect()->route('trash')->with('error', __('This action is unauthorized.'));
            }
        }

        try {
            Category::destroy($categories->id);
        } catch (\Throwable $th) {
            throw $th;
        }    
        
        // return notify
        $notify = __('Deleted');
        return redirect()->route('trash')->with('status', $notify);
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
