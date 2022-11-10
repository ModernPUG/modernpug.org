<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\DiscordThread;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class DiscordThreadController extends Controller
{
    public function __invoke(Request $request): View
    {
        $threads = DiscordThread::with('tags')
            ->when($request->keyword, function (Builder $builder) use ($request) {
                $builder->where('name', 'like', '%'.$request->keyword.'%');
            })
            ->latest('thread_started_at')
            ->paginate();

        return view('pages.threads.index', compact('threads'));
    }

}
