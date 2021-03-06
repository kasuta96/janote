<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        /**
         * Get recent note
         */
        $notes = Note::where('user_id',Auth::id())
        ->where('status',0)
        ->orderBy('updated_at', 'DESC')
        ->take(15)
        ->get();

        return view('home',['Notes'=>$notes]);
    }
}
