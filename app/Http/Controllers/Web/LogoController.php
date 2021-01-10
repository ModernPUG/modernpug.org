<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

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
