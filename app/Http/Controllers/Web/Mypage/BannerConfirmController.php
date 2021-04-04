<?php

namespace App\Http\Controllers\Web\Mypage;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Mypage\Banner\ApproveRequest;
use App\Http\Requests\Web\Mypage\Banner\DisapproveRequest;
use App\Models\Banner;

class BannerConfirmController extends Controller
{

    public function store(ApproveRequest $request, Banner $banner)
    {
        $banner->approved_at = now();
        $banner->approve_user()->associate($request->user());
        $banner->save();

        return response()->json([
            'result' => true,
            'message' => '승인되었습니다',
        ]);
    }


    public function destroy(DisapproveRequest $request, Banner $banner)
    {
        $banner->approved_at = null;
        $banner->approve_user()->associate(null);
        $banner->save();

        return response()->json([
            'result' => true,
            'message' => '승인 취소되었습니다',
        ]);
    }
}
