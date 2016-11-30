<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Dossier;
use App\Parentrep;

class ParentsrepController extends Controller
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
    	if ($data['lien_autre']!='') {
    		$data['lien']=$data['lien_autre'];
    	}
    	$dossier->parents()->update(['current'=>false]);
    	$parent=$dossier->parents()->create($data);
    	return redirect('dossiers/'.$dossier->id.'/show');
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
