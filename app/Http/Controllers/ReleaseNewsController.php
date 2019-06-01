<?php

namespace App\Http\Controllers;

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
    public function index()
    {
        $types = ReleaseNews::getAllReleaseTypes();
        $releases = ReleaseNews::getReleaseNews();
        $recentlyReleases = ReleaseNews::getRecentlyReleaseNews();

        return view('pages.news.index', compact('types', 'releases', 'recentlyReleases'));
    }
}
