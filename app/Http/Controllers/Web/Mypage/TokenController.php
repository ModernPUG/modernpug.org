<?php

namespace App\Http\Controllers\Web\Mypage;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TokenController extends Controller
{
    public function store(Request $request)
    {
        /**
         * @var User $user
         */
        $user = $request->user();

        $token = $user->createToken($request->get('name'));

        return response()->json(['token' => $token->plainTextToken], Response::HTTP_CREATED);
    }

    public function delete(Request $request, string $id)
    {
        /**
         * @var User $user
         */
        $user = $request->user();

        $user->tokens()->findOrFail($id)->delete();

        toastr()->success('토큰이 삭제되었습니다');

        return response()->noContent();
    }
}
