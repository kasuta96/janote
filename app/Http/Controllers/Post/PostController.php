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
        // $Posts = Post::all();

        $page = $request->input('p');
        $posts = DB::table('posts')
                    ->having('status','=',0)
                    ->orderByRaw('id DESC')
                    ->take(10)
                    ->when($page, function ($query, $page)
                    {
                        if ($page > 1) {
                            return $query->skip(10*($page - 1));
                        } else {
                            return false;
                        }
                    })
                    ->get()
                    ->each(function ($post) // get username by user_id
                    {
                        $user = DB::table('users')->having('id', '=', $post->user_id)->first();
                        $post->username = $user->name;
                    });

        // dd($posts); // show data like console.log
        return view('post.list', ['posts'=>$posts]);
    }

    public function createPost(Request $request)
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
}
