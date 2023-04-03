<?php

    namespace App\Http\Controllers\Comment;

    use App\Http\Controllers\Controller;
    use App\Http\Requests\Comment\UpdateRequest;
    use App\Models\Comment;

    class UpdateController extends Controller
    {
        public function __invoke(Comment $comment, UpdateRequest $request)
        {
            $data = $request->validated();

            $comment->fill($data)->save();
        }
    }
