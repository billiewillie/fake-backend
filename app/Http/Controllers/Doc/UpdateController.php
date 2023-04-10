<?php

namespace App\Http\Controllers\Doc;

use App\Http\Requests\Doc\UpdateRequest;
use App\Models\Doc;
use App\Http\Controllers\Controller;
use App\Models\Extension;
use Illuminate\Support\Facades\Storage;
use SplFileInfo;

class UpdateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateRequest $request, Doc $doc)
    {
        $data = $request->validated();

        if (isset($data["file"])) {
            $data['file'] = Storage::disk('public')->put('/docs', $data['file']);
            $file = new SplFileInfo($data['file']);
            $ext = strtolower($file->getExtension());
            $data['extension_id'] = Extension::firstOrCreate(['title' => $ext])->id;        }

        if (isset($data['is_published'])) {
            if (!$data['is_published']) {
                $data["unpublished_date"] = now();
            } else {
                $data["unpublished_date"] = null;
            }
        }

        $doc->fill($data)->save();
    }
}
