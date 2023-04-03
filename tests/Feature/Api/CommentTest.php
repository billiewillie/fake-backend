<?php

    namespace Tests\Feature\Api;

    use App\Models\Category;
    use App\Models\Comment;
    use App\Models\Post;
    use App\Models\Role;
    use App\Models\User;
    use Illuminate\Foundation\Testing\RefreshDatabase;
    use Illuminate\Http\Testing\File;
    use Illuminate\Support\Facades\Storage;
    use Tests\TestCase;

    class CommentTest extends TestCase
    {
        use RefreshDatabase;

        protected function setUp(): void
        {
            parent::setUp();
            $this->withHeaders([
                'accept' => 'application/json'
            ]);
        }

        /** @test */
        public function comment_can_be_stored(): void
        {
            $this->withoutExceptionHandling();

            $role = Role::factory()->create();
            $userToken = User::factory()->create(["role_id" => $role->id])->user_token;
            $categoryId = Category::factory()->create(["id" => 1])->id;
            $postId = Post::factory()->create(["category_id" => $categoryId])->id;
            $commentId = Comment::factory()->create()->id;

            $data = [
                'content' => 'test comment',
                'parent_id' => $commentId,
                'user_token' => $userToken,
                'post_id' => $postId
            ];

            $response = $this->post('/api/comments', $data);


            $this->assertDatabaseCount('comments', 2);

            $comment = Comment::find(2);

            $this->assertEquals($data["content"], $comment->content);
            $this->assertEquals($data["parent_id"], $comment->parent_id);
            $this->assertEquals($data["user_token"], $comment->user_token);
            $this->assertEquals($data["post_id"], $comment->post_id);
        }
    }
