<?php

namespace App\Http\Controllers\Mypage;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Mypage\User\DeleteRequest;
use App\Http\Requests\Web\Mypage\User\EditRequest;
use App\Http\Requests\Web\Mypage\User\IndexRequest;
use App\Http\Requests\Web\Mypage\User\RestoreRequest;
use App\Http\Requests\Web\Mypage\User\UpdateRequest;
use App\Models\Role;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
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
        $users = User::withTrashed()->with('blogs', 'oauth_identities')->withCount('blogs')->paginate(10);

        return view('pages.mypage.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
     * @param EditRequest $request
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(EditRequest $request, User $user)
    {
        $roles = Role::all();

        return view('pages.mypage.users.form', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param User $user
     * @return void
     */
    public function update(UpdateRequest $request, User $user)
    {
        $validated = $request->validated();

        $password = $request->get('password');
        if ($password) {
            $validated['password'] = Hash::make($password);
        }

        $user->update($validated);
        $user->syncRoles($request->get('roles'));

        Toastr::success('사용자 '.$user->name.'가 수정되었습니다.');

        return back();
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

        Toastr::success('사용자 '.$user->name.'가 삭제되었습니다.');

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
