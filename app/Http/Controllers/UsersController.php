<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
	public function __construct()
    {
        $this->middleware('isSuperadmin');
    }
    public function index()
    {
    	$users=User::all();
    	return view('users.index', compact('users'));
    }

    public function show(User $user)
    {
     return view('users.show', compact('user'));
    }

    public function delete(User $user)
    {	
    	$redirect='/utilisateurs';
    	if($user->id==Auth::user()->id){
    		Auth::logout();
    		$user->delete();
    		return redirect('/');
    	}
    	$user->delete();
    	return redirect($redirect);
    }

    public function edit(User $user)
    {
        return view('users/edit', compact('user'));
    }
    public function update(User $user, Request $request)
    {
        $this->validate($request, ['name'=>'required',
            'email' => ['required', Rule::unique('users')->ignore($user->id), 'email', 'max:255'],
            'role'=>'required',
            'password' => 'required|min:6|confirmed']
            );
        $user->update([
            'name' => $request['name'],
            'email' => $request['email'],
            'role'  => $request['role'], 
            'password' => bcrypt($request['password']),
        ]);
        return redirect('/utilisateurs/'.$user->id);
    }
}
