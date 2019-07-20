<?php

namespace App\Exceptions;

use Toastr;
use Illuminate\Http\Request;

trait ToastrWithRedirect
{
    public function render(Request $request)
    {
        $request->flash();
        $message = $this->getMessage();
        Toastr::error($message);

        return redirect($this->redirect);
    }
}
