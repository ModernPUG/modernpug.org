<?php

namespace App\Http\Controllers\Web;

use App\Exceptions\AlreadyClosedRecruitException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Recruit\CloseRequest;
use App\Http\Requests\Web\Recruit\CreateRequest;
use App\Http\Requests\Web\Recruit\DeleteRequest;
use App\Http\Requests\Web\Recruit\EditRequest;
use App\Http\Requests\Web\Recruit\RestoreRequest;
use App\Http\Requests\Web\Recruit\StoreRequest;
use App\Http\Requests\Web\Recruit\UpdateRequest;
use App\Models\Recruit;
use App\Models\User;
use App\Services\Jumpit\CachedRecruit;
use App\Services\Jumpit\ConvertRecruit;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Toastr;

class RecruitController extends Controller
{
    private CachedRecruit $searchRecruits;
    private ConvertRecruit $convertRecruit;

    public function __construct(CachedRecruit $searchRecruits, ConvertRecruit $convertRecruit)
    {
        $this->middleware(['auth:web', 'verified'])->except(['index']);
        $this->searchRecruits = $searchRecruits;
        $this->convertRecruit = $convertRecruit;
    }

    public function index(): View
    {
        $recruits = Recruit::where('expired_at', '>=', Carbon::now())
            ->whereNull('closed_at')
            ->get();

        $cachedRecruits = $this->searchRecruits->getCachedRecruits();

        $sponsorRecruits = collect();
        $sponsorUrl = $cachedRecruits?->result->link;
        if (is_array($cachedRecruits?->result->positions)) {
            foreach ($cachedRecruits->result->positions as $position) {
                $sponsorRecruits->add($this->convertRecruit->convert($position));
            }
        }

        return view('pages.recruits.index', compact('recruits', 'sponsorUrl', 'sponsorRecruits'));
    }

    public function create(CreateRequest $request): View
    {
        $recruit = Recruit::initializeWithDefault();

        return view('pages.recruits.create', compact('recruit'));
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        /**
         * @var User
         */
        $user = $request->user();

        $user->recruits()->save(Recruit::make($request->validated()));

        Toastr::success('등록이 완료되었습니다.');

        return redirect(route('recruits.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    public function edit(EditRequest $request, Recruit $recruit): View
    {
        return view('pages.recruits.edit', compact('recruit'));
    }

    public function update(UpdateRequest $request, Recruit $recruit): RedirectResponse
    {
        $recruit->update($request->validated());

        Toastr::success('수정이 완료되었습니다.');

        return back();
    }

    public function destroy(DeleteRequest $request, Recruit $recruit): RedirectResponse
    {
        $recruit->delete();

        Toastr::success('삭제가 완료되었습니다.');

        return back();
    }

    public function close(CloseRequest $request, Recruit $recruit): RedirectResponse
    {
        try {
            if ($recruit->closed_at) {
                throw new AlreadyClosedRecruitException();
            }

            $recruit->update([
                'closed_at' => now(),
                'closed_user_id' => auth()->user()?->getAuthIdentifier(),
            ]);

            Toastr::success('채용공고가 조기마감되었습니다. 노출이 재개됩니다');

            return back();
        } catch (\Exception $exception) {
            Toastr::warning($exception->getMessage());

            return back();
        }
    }

    public function restore(RestoreRequest $request, $id): RedirectResponse
    {
        Recruit::onlyTrashed()->findOrFail($id)->restore();

        Toastr::success('채용공고가 복구되었습니다. 노출이 재개됩니다');

        return back();
    }
}
