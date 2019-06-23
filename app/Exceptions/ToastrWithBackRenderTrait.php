<?php


namespace App\Exceptions;


use Illuminate\Http\Request;
use Toastr;

trait ToastrWithBackRenderTrait
{

    public function render(Request $request)
    {

        $request->flash();
        Toastr::error($this->getMessage());

        return back();
    }

}
