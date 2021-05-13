<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    //
    public function showPosts(Request $request)
    {
        // get request
        $page = $request->input('p');
        // get posts data
        $posts = Post::with('user')
        ->where('status','=',0)
        ->orderBy('id', 'DESC')
        ->take(10)
        ->when($page, function ($query, $page)
        {
            if ($page > 1) {
                return $query->skip(10*($page - 1));
            } else {
                return false;
            }
        })
        ->get();

        // get more data
        $data = new \stdClass();
        $data->totalPost = DB::table('posts')->where('status','=',0)->count();
        $data->totalPage = ceil($data->totalPost/10);
        $data->currentPage = $page ?? 1;
        
        return view('post.list', ['posts'=>$posts,'data'=>$data]);
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

    public function delete($id)
    {
        $post = Post::find($id);
        if (empty($post)) {
            return redirect()->route('posts')->with('error', 'データがありません！');
        }
        if ($post->user_id != Auth::user()->id) {
            return redirect()->route('posts')->with('error', '削除できません');
        }
        try {
            Post::destroy($id);
        } catch (\Throwable $th) {
            throw $th;
        }
        return redirect()->route('posts')->with('status', '削除しました');
    }
}
