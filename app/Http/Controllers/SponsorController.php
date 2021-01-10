<?php

namespace App\Http\Controllers;

class SponsorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        return view('pages.sponsors.sponsors');
    }
}
