<?php

namespace App\Http\Controllers\Download;

use App\Http\Controllers\Controller;
use App\Http\Requests\Download\StoreRequest;
use App\Models\Download;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();

        $download = Download::firstOrCreate([
            "doc_id" => $data["doc_id"],
            "user_token" => $data["user_token"],
        ]);

        $download->increment('download_count');
        $download->refresh();

        return $download;
    }
}
