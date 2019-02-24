<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ReleaseNews;

/**
 * @property ReleaseNews releaseNews
 */
class ReleaseNewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $types = ReleaseNews::mergeAllReleaseTypes();
        $releases = ReleaseNews::getReleaseNews();
        $recentlyReleases = ReleaseNews::getRecentlyReleaseNews();
        return view('pages.news.index', compact('types', 'releases', 'recentlyReleases'));
    }
}
