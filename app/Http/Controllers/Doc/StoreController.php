<?php

namespace App\Http\Controllers\Doc;

use App\Models\Doc;
use App\Http\Controllers\Controller;
use App\Models\Extension;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Doc\StoreRequest;
use SplFileInfo;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();

        if (isset($data['file'])) {
            $data['file'] = Storage::disk('public')->put('/docs', $data['file']);
            $file = new SplFileInfo($data['file']);
            $ext = strtolower($file->getExtension());
            $data['extension_id'] = Extension::firstOrCreate(['title' => $ext])->id;
        }

        return Doc::create($data);
    }
}
