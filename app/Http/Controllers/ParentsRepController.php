<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Dossier;
use App\ParentRep;

class ParentsRepController extends Controller
{
    public function create(Dossier $dossier)
    {
    	$id=$dossier->id;
    	return view('parents.create', compact('id'));
    }
    public function store(Dossier $dossier, Request $request)
    {
    	$rules=[
            'prenom'=>'required',
    		'nom'=>'required',
    		'lien'=>'required', 
    		'lieuT1'=>'required', 
    		'tel'=>'required', 
    	];
    	if($request->lien=="autre") {
    		$rules['lien_autre']='required';
    	}
    	if ($request->lieuT1=="maison") {
    		$rules['courriel']='required';
    	}
    	$this->validate($request,$rules);
    	$data=$request->all();
    	$dossier->parents()->update(['current'=>false]);
    	$parent=$dossier->parents()->create($data);
        if ($dossier->enseignants()->first()) {
            return redirect('dossiers/'.$dossier->id.'/show');
        }
        else {
            return redirect('enseignants/'.$dossier->id.'/create');
        }
    	
    }
    public function show(Parentrep $parent)
    {
        return view('parents.show', compact('parent'));
    }
    public function edit(Parentrep $parent)
    {
        return view('parents.edit', compact('parent'));
    }
}
