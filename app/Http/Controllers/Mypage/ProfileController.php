<?php

namespace App\Http\Controllers\Mypage;

use Hash;
use Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        $user = auth()->user();

        return view('pages.mypage.profile.form', compact('user'));
    }

    public function update(ProfileUpdateRequest $request)
    {
        $args = [
            'name' => $request->get('name'),
            'password' => Hash::make($request->get('password')),
        ];

        auth()->user()->update($args);

        Toastr::success('프로필이 수정되었습니다');

        return redirect(route('mypage.profile.show'));
    }
}
