<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function edit()
    {
        return view('auth.profile', ['Auth' => Auth::user()]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        // Rules
        $this->validate($request,[
            'name' => ['required', 'string', 'max:255'],
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            // 'birthday' => ['date'],
            'job' => ['max:255'],
            'description' => ['max:1000'],
        ]);
        $user->name = $request->name;
        $user->birthday = $request->birthday;
        $user->job = $request->job;
        $user->description = $request->description;
        // Change passwd
        if ($request->password)
        {
            $this->validate($request,[
                'password' => ['string', 'min:8', 'confirmed'],
            ]);
            $user->password = Hash::make($request->password);
        }
        // Change avatar
        if($request->hasFile('avatar'))
        {
            $uploaded = $request->file('avatar');
            $filename = $user->id.'.'.$uploaded->getClientOriginalName();
            $path = public_path('/uploads/avatars/');
            $uploaded->move($path,$filename);

            // if has old avatar
            if ($user->avatar != '/images/default-avatar.jpg') {
                if(\File::exists(public_path($user->avatar))) {
                    \File::delete(public_path($user->avatar));
                }
            }

            $user->avatar = '/uploads/avatars/'.$filename;
        }
        $user->save();
        return redirect()->route('editProfile')->with('status', __('Saved'));
    }
}
