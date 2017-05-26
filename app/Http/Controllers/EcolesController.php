<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Ecole;
use Illuminate\Validation\Rule;

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
    }

    public function show(Ecole $ecole)
    {
        return view('ecoles.show', compact('ecole'));
    }

    public function edit(Ecole $ecole)
    {
        return view('ecoles.edit', compact('ecole'));

    }

    public function update(Ecole $ecole, Request $request)
    {
        $this->validate($request,
                ['nom'=> ['required', Rule::unique('ecoles')->ignore($ecole->id)],
                'ville'=>'required']);

        $ecole->update($request->all());

        return redirect(url('ecoles/show', $ecole->id));
    }

}
