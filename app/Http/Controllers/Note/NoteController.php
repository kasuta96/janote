<?php

namespace App\Http\Controllers\Note;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Note;
use App\Http\Requests\NoteRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Classes\Hashtag;
use Illuminate\Database\Eloquent\Builder;

class NoteController extends Controller
{
    // Check login
    public function __construct()
    {
        $this->middleware('auth');
    }
    // function
    public function pagination($rq, $query)
    {
        $data = new \stdClass();
        $data->page = $rq->input('p') ?? 1;
        $data->count = $query->count() ?? 0;
        $data->limit = 25;
        $data->totalPage = ceil($data->count/$data->limit);
        return $data;
    }
    /**
     * Show notes list
     * 
     */
    public function index(Request $request)
    {
        // page request
        $params = [];
        if ($kw = $request->input('kw')) {
            $params['kw'] = $kw;
        }
        if ($request->input('c')) {
            $params['c'] = $request->input('c'); // Category id
        }
        if ($request->input('o')) {
            $params['o'] = $request->input('o'); // Order by
        }
        if ($request->input('s') == 'ASC' || $request->input('s') == 'DESC') {
            $params['s'] = $request->input('s');
        }

        if (isset($params['c']) && $params['c'] == 'other')
        {
            $query = Note::where('category_id',NULL);
            $Category = Category::find(1)->other;
        }
        else if (isset($params['c']))
        {
            $Category = Category::find($params['c']);
            // exits
            if (empty($Category)) {
                return redirect()->route('categories')->with('error', __('There is no data').'!');
            }
            // if user's category
            if (Auth::id() != $Category->user_id)
            {
                return redirect()->route('categories')->with('error', __('This action is unauthorized.'));
            }
            // query
            $query = Note::where('category_id',$params['c']);
        }
        else
        {
            // query
            $query = Note::whereHas('category', function (Builder $queryb) {
                $queryb->where('status', '=', 0);
            });
        }
        
        $query = $query->where('user_id',Auth::id())
        ->whereRaw("status = 0 AND (title LIKE '%$kw%' OR content LIKE '%$kw%')")
        ->orderBy($params['o'] ?? 'id', $params['s'] ?? 'DESC');
        // data
        $data = $this->pagination($request, $query);
        if (isset($Category)) {
            $data->category = $Category;
        }

        // notes data
        $notes = $query->skip($data->limit*($data->page - 1))
        ->take($data->limit)
        ->get();

        return view('note.list', ['Notes'=>$notes, 'Params'=>$params, 'Data'=>$data]);

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
    public function store(NoteRequest $request)
    {
        $input = $request->all();
        // if has Hashtag
        if (isset($input['tagArr'])) {
            $input['hashtag'] = implode(',',$input['tagArr']);
        }
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

        // check if word exist
        $sameWordQuery = Note::with('category')
        ->where('user_id',Auth::id())
        ->where('title',$input['title'])
        ->where('status',0);
        $sameWord = $sameWordQuery->get();

        // store data
        Note::create($input);

        if (count($sameWord) > 0) {
            return redirect(route('notes','kw='.$input['title']))->with('status', __('Saved').' & '.__('Found some duplicate word'));
        }

        // get Category info
        $category = Category::find($input['category_id']) ?? Category::find(1)->other;
        return redirect()->route('notes', ['c'=>$category->id] )->with('status', __('lang.savedto',['name' => $category->title ]));
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
        // if has Hashtag: array -> string
        if (isset($input['tagArr'])) {
            $input['hashtag'] = implode(',',$input['tagArr']);
        }
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
                'category_id' => $input['category_id'],
                'hashtag' => $input['hashtag'] ?? NULL,
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

        return redirect()->route('notes', ['c'=>($input['category_id'] ?? 'other')])->with('status', __('Update successful'));
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
                return redirect()->route('trash')->with('error', __('There is no data').'!');
            }
        }
        else
        {
            $Note = Note::find($rq);
            // check data
            if (empty($Note)) {
                return redirect()->route('trash')->with('error', __('There is no data').'!');
            }
            if ($Note->user_id != Auth::id())
            {
                return redirect()->route('trash')->with('error', __('This action is unauthorized.'));
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
        return redirect()->route('trash')->with('status', $notify);
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
                return redirect()->route('trash')->with('error', __('There is no data').'!');
            }
        }
        else
        {
            $Note = Note::find($rq);
            // check data
            if (empty($Note)) {
                return redirect()->route('trash')->with('error', __('There is no data').'!');
            }
            if ($Note->user_id != Auth::id())
            {
                return redirect()->route('trash')->with('error', __('This action is unauthorized.'));
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

        return redirect()->route('trash')->with('status', __('Restored').', '.$countNote.' '.__('Note'));
    }

}
