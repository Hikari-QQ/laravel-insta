<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    private $user;

    public function __construct(User $user) {
        $this->user = $user;
    }

    public function show($id) {
       $user = $this->user->findOrFail($id);
       
       return view('users.profile.show')->with('user', $user);
    }

    public function edit() {
        $user = $this->user->findOrFail(Auth::user()->id);

        return view('users.profile.edit')->with('user', $user);
    }

    public function update(Request $request) {
        $request->validate([
            'avatar' => 'mimes:jpeg,jpg,png,gif|max:1048',
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'introduction' => 'max:100'

        ]);
        $user = $this->user->findOrFail(Auth::user()->id);
        
        $user->name = $request->name;
        $user->email = $request->email;
        
        if($request->avatar) {
            $user->avatar = 'data:image/' . $request->avatar->extension() . ';base64,' . base64_encode(file_get_contents($request->avatar));
        }

        if($request->introduction) {
            $user->introduction = $request->introduction;
        }

        $user->save();

        return redirect()->route('profile.show', $user->id);
    }

    public function followers($id) {
        $user = $this->user->findOrFail($id);
       
       return view('users.profile.followers')->with('user', $user);
    }

    public function following($id) {
        $user = $this->user->findOrFail($id);
       
       return view('users.profile.following')->with('user', $user);
    }
}
