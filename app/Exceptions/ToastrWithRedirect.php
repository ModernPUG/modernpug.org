<?php

namespace App\Exceptions;

use Illuminate\Http\Request;

trait ToastrWithRedirect
{
    public function render(Request $request)
    {
        $request->flash();
        $message = $this->getMessage();
        toastr()->error($message);

        return redirect($this->redirect);
    }
}
