<?php

namespace App\Http\Controllers\Mypage;


use App\Http\Requests\Web\Mypage\User\DeleteRequest;
use App\Http\Requests\Web\Mypage\User\IndexRequest;
use App\Http\Requests\Web\Mypage\User\RestoreRequest;
use App\Http\Requests\Web\Mypage\User\UpdateRequest;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Toastr;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return \Illuminate\Http\Response
     */
    public function index(IndexRequest $request)
    {
        $users = User::withTrashed()->with('blogs')->withCount('blogs')->paginate(10);

        return view('pages.mypage.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //d
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param int $id
     * @return void
     */
    public function update(UpdateRequest $request, $id)
    {


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DeleteRequest $request
     * @param User $user
     * @return void
     * @throws \Exception
     */
    public function destroy(DeleteRequest $request, User $user)
    {


        $user->delete();

        Toastr::success('사용자 ' . $user->name . '가 삭제되었습니다.');

        return back();


    }


    /**
     * @param RestoreRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore(RestoreRequest $request, $id)
    {


        User::onlyTrashed()->findOrFail($id)->restore();

        Toastr::success('사용자의 복구가 완료되었습니다');

        return back();
    }

}
