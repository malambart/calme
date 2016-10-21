<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Ecole;

class EcolesController extends Controller
{
    public function create()
    {
    return view('ecoles.create');
    }
    public function store(Request $request)
    {
    $this->validate($request, ['nom'=>'required|unique:ecoles', 'ville'=>'required']);
    Ecole::create($request->all());
    flash('École correctement ajoutée', 'success');
    return back();
    }

}
