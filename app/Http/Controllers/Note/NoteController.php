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
        // query
        $query = Note::where('category_id','=',$id)
        ->where('status','=',0)
        ->orderBy('id', 'DESC');
        // Count
        $data = new \stdClass();
        $data->count = $query->count();
        $data->page = $page;
        $data->limit = 25;
        $data->totalPage = ceil($data->count/$data->limit);
        // notes data
        $notes = $query->skip($data->limit*($page - 1))
        ->take($data->limit)
        ->get();

        return view('note.list', ['Notes'=>$notes, 'Category'=>$Category, 'Data'=>$data]);
    }

    /**
     * Show create page
     * 
     */
    public function create(Request $request)
    {
        if (!Auth::check()) // if not login
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
            $path = public_path('/uploads/images/');
            $uploaded->move($path,$filename);
            $input['image'] = '/uploads/images/'.$filename;
        }
        // Audio
        if (request()->has('audio')) {
            $uploaded = request()->file('audio');
            $filename = time().'.'.$uploaded->getClientOriginalName();
            $path = public_path('/uploads/audios/');
            $uploaded->move($path,$filename);
            $input['audio'] = '/uploads/audios/'.$filename;
        }
        // store data
        Note::create($input);
        return redirect()->route('notes', $input['category_id'] ?? 0)->with('status', 'push success!');
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
        $Note = Note::find($input['id']);
        // check auth
        if (empty($Note)) {
            return redirect()->route('home')->with('error', __('There is no data').'!');
        }
        if ($Note->user_id != Auth::id()) {
            return redirect()->route('home')->with('error', __('This action is unauthorized.'));
        }
        try {
            $Note->fill([
                'title' => $input['title'],
                'content' => $input['content'],
                'category_id' => $input['category_id']
            ]);
            $Note->save();
        } catch (\Throwable $th) {
            throw $th;
        }
        // photo
        if (request()->has('photo')) {
            $uploaded = request()->file('photo');
            $filename = time().'.'.$uploaded->getClientOriginalName();
            $path = public_path('/uploads/images/');
            $uploaded->move($path,$filename);
            // Save
            $Note->fill([
                'image' => '/uploads/images/'.$filename
            ]);
            $Note->save();
        }
        // Audio
        if (request()->has('audio')) {
            $uploaded = request()->file('audio');
            $filename = time().'.'.$uploaded->getClientOriginalName();
            $path = public_path('/uploads/audios/');
            $uploaded->move($path,$filename);
            // Save
            $Note->fill([
                'audio' => '/uploads/audios/'.$filename
            ]);
            $Note->save();
        }        

        return redirect()->route('notes', $input['category_id'])->with('status', __('Update successful'));
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
        try
        {
            // Change status (0: active, 9: deleted)
            $Note->fill([
                'status' => 9,
            ]);
            $Note->save();
        }
        catch (\Throwable $th)
        {
            throw $th;
        }
        return redirect()->back()->with('status', __('Moved to trash'));
    }

    /**
     * Show deleted note (trash)
     * 
     */
    public function trash(Request $request)
    {
        if (!Auth::check()) // if not login
        {
            return redirect()->route('login');
        }
        // page request
        $page = $request->input('p') ?? 1;
        // query
        $query = Note::with('category')
        ->where('user_id','=',Auth::id())
        ->where('status','=',9)
        ->orderBy('id', 'DESC');
        // data
        $data = new \stdClass();
        $data->count = $query->count();
        $data->page = $page;
        $data->limit = 25;
        $data->totalPage = ceil($data->count/$data->limit);
        // notes data
        $notes = $query->skip($data->limit*($page - 1))
        ->take($data->limit)
        ->get();

        return view('note.trash', ['Notes'=>$notes, 'Category'=>'Trash', 'Data'=>$data]);
    }

    public function remove($rq)
    {
        // get note data
        if ($rq == 'all')
        {
            $Notes = Note::where('status','=',9)
            ->where('user_id','=',Auth::id())
            ->get();
            // check data
            if (count($Notes) == 0) {
                return redirect()->route('trashNote')->with('error', __('There is no data').'!');
            }
        }
        else
        {
            $Note = Note::find($rq);
            // check data
            if (empty($Note)) {
                return redirect()->route('trashNote')->with('error', __('There is no data').'!');
            }
            if ($Note->user_id != Auth::id())
            {
                return redirect()->route('trashNote')->with('error', __('This action is unauthorized.'));
            }
            $Notes = [$Note];
        }
        
        // Count deleted data
        $countImg = 0;
        $countAudio = 0;
        $countNote = 0;
        foreach ($Notes as $Note) {
            // if has image
            if ($Note->image) {
                if(\File::exists(public_path($Note->image))) {
                    \File::delete(public_path($Note->image));
                    $countImg++;
                }
            }
            // if has audio
            if ($Note->image) {
                if(\File::exists(public_path($Note->audio))) {
                    \File::delete(public_path($Note->audio));
                    $countAudio++;
                }
            }
            try {
                Note::destroy($Note->id);
                $countNote++;
            } catch (\Throwable $th) {
                throw $th;
            }    
        }
        // return notify
        $notify = __('Deleted');
        if ($countImg > 0) {
            $notify .= ', '.$countImg.' '.__('Photo');
        }
        if ($countAudio > 0) {
            $notify .= ', '.$countAudio.' '.__('Audio');
        }
        if ($countNote > 0) {
            $notify .= ', '.$countNote.' '.__('Note');
        }
        return redirect()->route('trashNote')->with('status', $notify);
    }

    public function restore($rq)
    {
        // get note data
        if ($rq == 'all')
        {
            $Notes = Note::where('status','=',9)
            ->where('user_id','=',Auth::id())
            ->get();
            // check data
            if (count($Notes) == 0) {
                return redirect()->route('trashNote')->with('error', __('There is no data').'!');
            }
        }
        else
        {
            $Note = Note::find($rq);
            // check data
            if (empty($Note)) {
                return redirect()->route('trashNote')->with('error', __('There is no data').'!');
            }
            if ($Note->user_id != Auth::id())
            {
                return redirect()->route('trashNote')->with('error', __('This action is unauthorized.'));
            }
            $Notes = [$Note];
        }
        
        // Count deleted data
        $countNote = 0;
        foreach ($Notes as $Note) {
            // Change status (0: active, 9: deleted)
            $Note->fill([
                'status' => 0,
            ]);
            $Note->save();
            $countNote++;
        }

        return redirect()->route('trashNote')->with('status', __('Restored').', '.$countNote.' '.__('Note'));
    }

    /**
     * Show notes (search)
     * 
     */
    public function search(Request $request)
    {
        if (!Auth::check()) // if not login
        {
            return redirect()->route('login');
        }
        // page request
        $page = $request->input('p') ?? 1;
        $kw = $request->input('kw');
        // query
        $query = Note::with('category')
        ->whereRaw("status = 0 AND (title LIKE '%$kw%' OR content LIKE '%$kw%')")
        ->orderBy('id', 'DESC');
        // data
        $data = new \stdClass();
        $data->count = $query->count();
        $data->page = $page;
        $data->limit = 25;
        $data->totalPage = ceil($data->count/$data->limit);
        // notes data
        $notes = $query->skip($data->limit*($page - 1))
        ->take($data->limit)
        ->get();

        return view('note.search', ['Notes'=>$notes, 'Keyword'=>$kw, 'Data'=>$data]);
    }

}
