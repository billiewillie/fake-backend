<?php

    namespace App\Http\Controllers\Comment;

    use App\Http\Controllers\Controller;
    use App\Models\Comment;
    use Illuminate\Http\Request;

    class DestroyController extends Controller
    {
        public function __invoke(Comment $comment)
        {
            $comment->delete();
        }
    }
