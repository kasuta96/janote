<?php

namespace App\Http\Controllers\Note;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Note;
use App\Http\Requests\NoteRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class NoteController extends Controller
{
    /**
     * Show notes list
     * 
     */
    public function index($id, Request $request)
    {
        $Category = Category::find($id);
        // exits
        if (empty($Category)) {
            return redirect()->route('categories')->with('error', __('There is no data').'!');
        }
        // if user's category
        if (Auth::id() != $Category->user_id)
        {
            return redirect()->route('categories')->with('error', __('This action is unauthorized.'));
        }
        // page request
        $page = $request->input('p') ?? 1;
        // notes data
        $notes = Note::where('category_id','=',$id)
        ->orderBy('id', 'DESC')
        ->skip(25*($page - 1))
        ->take(25)
        ->get();

        return view('note.list', ['Notes'=>$notes, 'Category'=>$Category]);
    }

    /**
     * Show create page
     * 
     */
    public function create(Request $request)
    {
        if (!Auth::check()) // if login
        {
            return redirect()->route('login');
        }

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
    public function store(NoteRequest $request)
    {
        if (!Auth::check()) // if login
        {
            return redirect()->route('login');
        }

        $input = $request->all();
        $input['user_id'] = Auth::id();

        // photo
        if (request()->has('photo')) {
            $uploaded = request()->file('photo');
            $filename = time().'.'.$uploaded->getClientOriginalName();
            $path = public_path('/images/');
            $uploaded->move($path,$filename);
            $input['image'] = '/images/'.$filename;
        }
        // store data
        Note::create($input);
        return redirect()->route('notes', $input['category_id'] ?? 0)->with('status', 'push success!');
    }

    /**
     * delete note
     * 
     */
    public function delete($id)
    {
        $Note = Note::find($id);
        if (empty($Note)) {
            return redirect()->back()->with('error', __('There is no data').'!');
        }
        if ($Note->user_id != Auth::id()) {
            return redirect()->back()->with('error', __('This action is unauthorized.'));
        }
        try {
            // if has image
            if ($Note->image) {
                if(\File::exists(public_path($Note->image))) {
                    \File::delete(public_path($Note->image));
                }
            }
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
            return redirect()->back()->with('error', __('There is no data').'!');
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
    public function update(NoteRequest $request)
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
