<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ReleaseNews;
use Log;

/**
 * @property ReleaseNews releaseNews
 */
class ReleaseNewsController extends Controller
{
    public function __construct(ReleaseNews $releaseNews) {
        $this->releaseNews = $releaseNews;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $types = $this->releaseNews::mergeAllReleaseTypes();
        $releases = $this->releaseNews::getReleaseNews();
        return view('pages.news.index', compact('types', 'releases'));
    }
}
