<?php

namespace App\Http\Controllers\Web\Mypage;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Toastr;

class TokenController extends Controller
{
    public function store(Request $request)
    {
        /**
         * @var User $user
         */
        $user = $request->user();

        $user->createToken($request->get('name'));

        return response()->noContent(Response::HTTP_CREATED);
    }

    public function delete(Request $request, string $id)
    {
        /**
         * @var User $user
         */
        $user = $request->user();

        $user->tokens()->findOrFail($id)->delete();

        Toastr::success('토큰이 삭제되었습니다');

        return response()->noContent();
    }
}
