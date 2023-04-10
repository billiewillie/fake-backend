<?php

namespace App\Http\Controllers\Doc;

use App\Http\Controllers\Controller;
use App\Models\Doc;
use Illuminate\Http\Request;

class DestroyController extends Controller
{
    public function __invoke(Request $request, Doc $doc)
    {
        $doc->delete();
    }
}
