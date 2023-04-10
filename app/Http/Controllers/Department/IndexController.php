<?php

namespace App\Http\Controllers\Department;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Database\Eloquent\Collection;

class IndexController extends Controller
{
    public function __invoke(): Collection
    {
        return Department::all();
    }
}
