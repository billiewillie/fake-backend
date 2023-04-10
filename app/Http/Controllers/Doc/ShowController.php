<?php

namespace App\Http\Controllers\Doc;

use App\Http\Controllers\Controller;
use App\Models\Doc;

class ShowController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Doc $doc)
    {
        $doc->increment('download_count');
        return $doc;
    }
}
