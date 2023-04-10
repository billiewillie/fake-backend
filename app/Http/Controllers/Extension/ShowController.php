<?php

namespace App\Http\Controllers\Extension;

use App\Http\Controllers\Controller;
use App\Models\Extension;

class ShowController extends Controller
{
    public function __invoke(Extension $extension)
    {
        return $extension;
    }
}
