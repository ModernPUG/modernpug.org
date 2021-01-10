<?php

namespace App\Http\Controllers;

use App\Models\User;

class AboutUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $facilitators = User::role('facilitators')->get();

        return view('pages.aboutus.index', compact('facilitators'));
    }
}
