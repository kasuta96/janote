<?php

namespace App\Http\Controllers\Note;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Note;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    /**
     * Show notes list
     * 
     */
    public function index($id, Request $request)
    {
        $Category = Category::find($id);
        // if user's category
        if (Auth::id() == $Category->user_id)
        {
            // page request
            $page = $request->input('p') ?? 1;
            // notes data
            $notes = Note::where('category_id','=',$id)
            ->orderBy('id', 'DESC')
            ->skip(25*($page - 1))
            ->take(25)
            ->get();

            // dd($notes);
            return view('note.list', ['Notes'=>$notes, 'Category'=>$Category]);
        }
        else
        {
            return redirect()->route('categories')->with('error', __('This action is unauthorized.'));
        }
    }

    /**
     * Show create page
     * 
     */
    public function create(Request $request)
    {
        // get categories list
        $Categories = Category::where('user_id','=',Auth::id())->get();
        if ($request['category']) {
            return view('note.create', ['Categories'=>$Categories,'selected'=>$request['category']]);
        }
        else
        {
            return view('note.create', ['Categories'=>$Categories,'selected'=>'']);
        }
    }

    /**
     * store created note
     * 
     */
    public function store(Request $request)
    {
        $input = $request->all();
        if (Auth::check()) // if login
        {
            if (isset($input['title']) && isset($input['category_id'])) {
                $input['user_id'] = Auth::id();
                Note::create($input);
                return redirect()->route('notes', $input['category_id'] ?? 0)->with('status', 'push success!');
            }
            else
            {
                return redirect()->back()->with('error', 'Input data first!');
            }
        }
        else // if not login
        {
            return redirect()->route('login');
        }
    }

    /**
     * delete note
     * 
     */
    public function delete($id)
    {
        $Note = Note::find($id);
        if (empty($Note)) {
            return redirect()->back()->with('error', 'データがありません！');
        }
        if ($Note->user_id != Auth::id()) {
            return redirect()->back()->with('error', __('This action is unauthorized.'));
        }
        try {
            Note::destroy($id);
        } catch (\Throwable $th) {
            throw $th;
        }
        return redirect()->back()->with('status', __('Deleted'));
    }

    /**
     * Edit note
     * 
     */
    public function edit($id)
    {
        $Note = Note::find($id);
        if (empty($Note)) {
            return redirect()->back()->with('error', 'データがありません！');
        }
        if ($Note->user_id != Auth::id()) {
            return redirect()->back()->with('error', __('This action is unauthorized.'));
        }

        // get categories list
        $Categories = Category::where('user_id','=',Auth::id())->get();

        return view('note.edit', ['Note'=>$Note, 'Categories'=>$Categories]);
    }

    /**
     * Update note
     * 
     */
    public function update(Request $request)
    {
        $input = $request->all();
        try {
            $Note = Note::find($input['id']);
            $Note->fill([
                'title' => $input['title'],
                'content' => $input['content'],
                'category_id' => $input['category_id']
            ]);
            $Note->save();
        } catch (\Throwable $th) {
            throw $th;
        }
        return redirect()->route('notes', $input['category_id'])->with('status', __('Update successful'));
    }
}
