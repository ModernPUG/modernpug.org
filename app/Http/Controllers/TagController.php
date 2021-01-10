<?php

namespace App\Http\Controllers;

use App\Models\Tag;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $managedTags = Tag::MANAGED_TAGS;
        $allTags = Tag::orderBy('name')->get();

        return view('pages.tags.index', compact('managedTags', 'allTags'));
    }
}
