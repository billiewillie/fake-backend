<?php

    namespace App\Http\Controllers\Comment;

    use App\Http\Controllers\Controller;
    use App\Models\Comment;
    use Illuminate\Http\Request;

    class ShowController extends Controller
    {
        public function __invoke(Comment $comment): Comment
        {
            return $comment;
        }
    }
