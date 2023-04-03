<?php

    namespace App\Http\Controllers\Comment;

    use App\Http\Controllers\Controller;
    use App\Http\Requests\Comment\StoreRequest;
    use App\Models\Comment;

    class StoreController extends Controller
    {
        public function __invoke(StoreRequest $request)
        {
            $data = $request->validated();

            if (isset($data['parent_id'])) {
                $data['post_id'] = Comment::find($data["parent_id"])->post_id;
            }

            return Comment::create($data);
        }
    }
