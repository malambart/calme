<?php

namespace App\Http\Controllers;
use App\Activity;

use Illuminate\Http\Request;

class ActivitiesController extends Controller
{
    public function index()
    {
        $activities = Activity::orderBy('created_at', 'Desc')->simplePaginate(10);

        return view('activities.index', compact('activities'));

    }
}
