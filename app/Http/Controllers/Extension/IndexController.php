<?php

namespace App\Http\Controllers\Extension;

use App\Http\Controllers\Controller;
use App\Models\Extension;

class IndexController extends Controller
{
    public function __invoke()
    {
        return Extension::all();
    }
}
