<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User ;
use Auth;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    public function display() {
    	$user = User::find(Auth::id()) ;
    	return view('user.display', compact('user')) ;
    }

    public function showUpdateForm() {
    	return view('user.update') ;
    }

    public function showAvatarForm() {
        $user = User::find(Auth::id()) ;
        return view('user.avatar',compact('user')) ;
    }

    public function update(Request $request) {
    	$validatedData  = $request->validate([
            'hobby' => 'required',
            'objective' => 'required',
            'quote' => 'required'
        ]);

        $user = User::find(Auth::id()) ;
        $user->hobby = $request->input('hobby') ;
        $user->objective = $request->input('objective') ;
        $user->quote = $request->input('quote') ;
        $user->save() ;

        return $this->display();
    }

    public function uploadAvatar(Request $request) {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
 
        $user = Auth::user();
        $avatarName = $user->id.'_avatar'.time().'.'.request()->avatar->getClientOriginalExtension();
        $request->avatar->storeAs('avatars',$avatarName);
        $file = 'avatars/'.$user->avatar ;

        if ($user->avatar) {
            Storage::delete($file);
        }

        $user->avatar = $avatarName;
        $user->save();
 
        return $this->display();
    }
}
