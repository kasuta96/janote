<?php

namespace App\Http\Controllers\Hashtag;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Note;
use Illuminate\Support\Facades\Auth;


class HashtagController extends Controller
{
    public function show()
    {
        return view('hashtag.lists');
    }

    public function wordtag(Request $request,$id)
    {
        $page = $request->input('p') ?? 1;
        // query
        $query = Note::with('user')
        ->whereRaw("status = 0 AND (hashtag LIKE '%$id%')")
        ->orderBy('updated_at', 'DESC');
        // pagination data
        $pagination = $this->pagination($request, $query);

        // notes data
        $notes = $query->skip($pagination->limit*($pagination->page - 1))
        ->take($pagination->limit)
        ->get();

        return view('hashtag.tagged', ['Notes'=>$notes, 'Id'=>$id , 'Data'=>$pagination]);
    }
    
    public function pagination($rq, $query)
    {
        $data = new \stdClass();
        $data->page = $rq->input('p') ?? 1;
        $data->count = $query->count() ?? 0;
        $data->limit = 25;
        $data->totalPage = ceil($data->count/$data->limit);
        return $data;
    }
}
?>