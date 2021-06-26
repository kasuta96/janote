<?php

namespace App\Http\Controllers\Note;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Note;
use Illuminate\Support\Facades\Auth;

class AxiosController extends Controller
{
    //
    public function studied(Request $request)
    {
        $Note = Note::find($request->input('id'));
        try {
            // empty
            if (!isset($Note)) {
                return [
                    'status' => 'error',
                    'msg' => __('There is no data').'!',
                ];
            }
            // isn't user's note
            if ($Note->user_id != Auth::id()) {
                return [
                    'status' => 'error',
                    'msg' => __('This action is unauthorized.'),
                ];
            }
            // studied
            if ($Note->mark == 1) {
                $Note->mark = 2;
                $Note->save();
                return [
                    'status' => 'studied',
                ];
            } else {
                $Note->mark = 1;
                $Note->save();
                return [
                    'status' => 'studying',
                ];
            }
        } catch (\Throwable $th) {
            return $th;
        }
    }
}
