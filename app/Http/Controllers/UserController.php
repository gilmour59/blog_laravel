<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\Users\UpdateUserRequest;

class UserController extends Controller
{
    public function index(){
        return view('users.index')->with('users', User::all());
    }

    public function profile(){
        return view('users.profile')->with('user', auth()->user());
    }

    public function update(UpdateUserRequest $request){
        $user = auth()->user();

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'about' => $request->about
        ]);

        session()->flash('success', 'Profile Updated!');

        return redirect()->back();
    }

    public function makeAdmin(User $user){

        if ($user->role === 'admin') {
            session()->flash('error', $user->name . ' is already Admin!');

            return redirect()->route('users.index');
        }else{
            $user->role = 'admin';
            $user->save();

            session()->flash('success', $user->name . ' is now Admin!');

            return redirect()->route('users.index');
        }
    }
}
