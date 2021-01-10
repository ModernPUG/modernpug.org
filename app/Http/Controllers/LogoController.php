<?php

namespace App\Http\Controllers;

class LogoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        return view('pages.brand.index');
    }
}
