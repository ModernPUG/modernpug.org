<?php

namespace App\Http\Controllers;

use App\Http\Requests\Web\Recruit\CreateRequest;
use App\Http\Requests\Web\Recruit\DeleteRequest;
use App\Http\Requests\Web\Recruit\EditRequest;
use App\Http\Requests\Web\Recruit\RestoreRequest;
use App\Http\Requests\Web\Recruit\StoreRequest;
use App\Http\Requests\Web\Recruit\UpdateRequest;
use App\Models\Recruit;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Toastr;

class RecruitController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:web', 'verified'])->except(['index']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recruits = Recruit::where('expired_at', '>=', Carbon::now())->get();

        return view('pages.recruits.index', compact('recruits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param CreateRequest $request
     * @return void
     */
    public function create(CreateRequest $request)
    {
        $recruit = Recruit::initializeWithDefault();

        return view('pages.recruits.create', compact('recruit'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
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
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param EditRequest $request
     * @param Recruit $recruit
     * @return \Illuminate\Http\Response
     */
    public function edit(EditRequest $request, Recruit $recruit)
    {
        return view('pages.recruits.edit', compact('recruit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Recruit $recruit
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Recruit $recruit)
    {
        $recruit->update($request->validated());

        Toastr::success('수정이 완료되었습니다.');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DeleteRequest $request
     * @param Recruit $recruit
     * @return void
     * @throws \Exception
     */
    public function destroy(DeleteRequest $request, Recruit $recruit)
    {
        $recruit->delete();

        Toastr::success('삭제가 완료되었습니다.');

        return back();
    }

    /**
     * @param RestoreRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(RestoreRequest $request, $id)
    {
        Recruit::onlyTrashed()->findOrFail($id)->restore();

        Toastr::success('채용공고가 복구되었습니다. 노출이 재개됩니다');

        return back();
    }
}
