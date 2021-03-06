<?php

namespace App\Http\Controllers;

use App\Journal;
use App\Dossier;
use Illuminate\Http\Request;

class JournalsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Dossier  $dossier
     * @return \Illuminate\Http\Response
     */
    public function index(Dossier $dossier)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Dossier  $dossier
     * @return \Illuminate\Http\Response
     */
    public function create(Dossier $dossier)
    {
        return view('journals.create', compact('dossier'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Dossier  $dossier
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Dossier $dossier)
    {
        $this->validate($request, [
            'date' => 'required'
        ]);
        $journal = $dossier->journals()->create($request->all());
        return redirect(url('journals/show', $journal->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Dossier  $dossier
     * @param  \App\Journal  $journal
     * @return \Illuminate\Http\Response
     */
    public function show(Journal $journal)
    {
        $dossier = $journal->dossier;
        return view('journals.show', compact('dossier', 'journal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Dossier  $dossier
     * @param  \App\Journal  $journal
     * @return \Illuminate\Http\Response
     */
    public function edit(Journal $journal)
    {
        $dossier = $journal->dossier;
        return view('journals/edit', compact('dossier', 'journal'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Dossier  $dossier
     * @param  \App\Journal  $journal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Journal $journal)
    {
        $this->validate($request, [
            'date' => 'required'
        ]);
        $journal->update($request->all());
        return redirect(url('journals/show', $journal->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dossier  $dossier
     * @param  \App\Journal  $journal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dossier $dossier, Journal $journal)
    {
        //
    }
}
