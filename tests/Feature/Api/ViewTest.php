<?php

    namespace Tests\Feature\Api;

    use App\Models\Category;
    use App\Models\Post;
    use App\Models\Role;
    use App\Models\User;
    use Illuminate\Foundation\Testing\RefreshDatabase;
    use Illuminate\Support\Facades\Storage;
    use Tests\TestCase;

    class ViewTest extends TestCase
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
        public function view_can_be_stored(): void
        {
            $this->withoutExceptionHandling();

            $role = Role::factory()->create();
            $categoryId = Category::factory()->create(["id" => 1])->id;
            $author = User::factory()->create(["role_id" => $role->id]);
            $authorId = $author->id;
            $userToken = $author->user_token;
            $post = Post::factory()->create([
                'author_id' => $authorId,
                'category_id' => $categoryId,
            ]);
            $postId = $post->id;

            $data = [
                "post_id" => $postId,
                'user_token' => $userToken,
            ];

            $response = $this->post('/api/views', $data);

            $this->assertDatabaseCount('views', 1);
        }

        /** @test */
        public function attribute_post_id_is_required_for_storing_view(): void
        {
            $role = Role::factory()->create();
            $categoryId = Category::factory()->create(["id" => 1])->id;
            $author = User::factory()->create(["role_id" => $role->id]);
            $authorId = $author->id;
            $userToken = $author->user_token;
            $post = Post::factory()->create([
                'author_id' => $authorId,
                'category_id' => $categoryId,
            ]);
            $postId = $post->id;

            $data = [
                "post_id" => null,
                'user_token' => $userToken,
                'is_liked' => 1,
            ];

            $response = $this->post('/api/views', $data);

            $response->assertStatus(422);
            $response->assertInvalid('post_id');
        }

        /** @test */
        public function attribute_user_token_is_required_for_storing_view(): void
        {
            $role = Role::factory()->create();
            $categoryId = Category::factory()->create(["id" => 1])->id;
            $author = User::factory()->create(["role_id" => $role->id]);
            $authorId = $author->id;
            $userToken = $author->user_token;
            $post = Post::factory()->create([
                'author_id' => $authorId,
                'category_id' => $categoryId,
            ]);
            $postId = $post->id;

            $data = [
                "post_id" => $postId,
                'user_token' => null,
                'is_liked' => 1,
            ];

            $response = $this->post('/api/views', $data);

            $response->assertStatus(422);
            $response->assertInvalid('user_token');
        }
    }
