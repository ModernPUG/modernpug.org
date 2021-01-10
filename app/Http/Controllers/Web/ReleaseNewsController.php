<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\ReleaseNews;

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
    public function __invoke()
    {
        $types = ReleaseNews::getAllReleaseTypes();
        $releases = ReleaseNews::getReleaseNews();
        $recentlyReleases = ReleaseNews::getRecentlyReleaseNews();

        return view('pages.news.index', compact('types', 'releases', 'recentlyReleases'));
    }
}
