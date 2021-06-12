<?php

namespace App\Http\Controllers\Web\Mypage;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\File;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerImageController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(Banner $banner, File $image): JsonResponse
    {
        try {
            if ($banner->images()->count() <= 1) {
                throw new \Exception('배너 이미지는 최소한 1개는 있어야 합니다.');
            }

            Storage::delete($image->file_path);

            $image->delete();

            return response()->json([
                'result' => true,
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'result' => false,
                'error' => [
                    'code' => $exception->getCode(),
                    'message' => $exception->getMessage(),
                ],
            ],
                $exception->getCode() ?: 400);
        }
    }
}
