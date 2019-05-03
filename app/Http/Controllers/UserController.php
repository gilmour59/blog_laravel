<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index(){
        return view('users.index')->with('users', User::all());
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