<?php

namespace App\Http\Controllers\Doc;

use App\Http\Controllers\Controller;
use App\Models\Doc;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return Doc::departmentId($request)
            ->extensionId($request)
            ->search($request)
            ->order($request)
            ->isPublished($request)
            ->get();
    }
}
