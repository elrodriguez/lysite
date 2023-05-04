<?php

namespace Modules\Investigation\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class GetReferencesController extends Controller
{
    public function getReferences(Request $request)
    {
        dd($request->all());
    }
}
