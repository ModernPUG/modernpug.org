<?php

namespace App\Exceptions;

use Illuminate\Http\Request;
use Toastr;

trait ToastrWithBackRenderTrait
{
    public function render(Request $request)
    {
        $request->flash();
        $message = $this->getMessage();
        Toastr::error($message);

        return back();
    }
}
