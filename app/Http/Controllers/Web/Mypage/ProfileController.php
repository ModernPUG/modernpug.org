<?php

namespace App\Http\Controllers\Web\Mypage;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        $user = $request->user();

        return view('pages.mypage.profile.form', compact('user'));
    }

    public function update(ProfileUpdateRequest $request)
    {
        $args = $request->validated();

        $password = $request->get('password');
        if ($password) {
            $args['password'] = Hash::make($password);
        }

        /**
         * @var User $user
         */
        $user = $request->user();

        $user->update($args);

        toastr()->success('프로필이 수정되었습니다');

        return redirect(route('mypage.profile.show'));
    }
}
