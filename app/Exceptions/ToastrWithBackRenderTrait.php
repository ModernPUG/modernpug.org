<?php

namespace App\Exceptions;

use Illuminate\Http\Request;

trait ToastrWithBackRenderTrait
{
    public function render(Request $request)
    {
        $request->flash();
        $message = $this->getMessage();
        toastr()->error($message);

        return back();
    }
}
