<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use Illuminate\Support\Facades\Auth;

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
}
