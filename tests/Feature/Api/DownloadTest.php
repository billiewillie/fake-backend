<?php

namespace Tests\Feature\Api;

use App\Models\Department;
use App\Models\Doc;
use App\Models\Extension;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DownloadTest extends TestCase
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
    public function download_can_be_stored(): void
    {
        $this->withoutExceptionHandling();

        $role = Role::factory()->create();
        $departmentId = Department::factory()->create(["id" => 1])->id;
        $extensionId = Extension::factory()->create(["id" => 1])->id;
        $author = User::factory()->create(["role_id" => $role->id]);
        $authorId = $author->id;
        $userToken = $author->user_token;
        $doc = Doc::factory()->create([
            'author_id' => $authorId,
            'department_id' => $departmentId,
            'extension_id' => $extensionId
        ]);

        $docId = $doc->id;

        $data = [
            "doc_id" => $docId,
            'user_token' => $userToken,
        ];

        $this->post('/api/downloads', $data);

        $this->assertDatabaseCount('downloads', 1);
    }

    /** @test */
    public function attribute_doc_id_is_required_for_storing_download(): void
    {
        $role = Role::factory()->create();
        $departmentId = Department::factory()->create(["id" => 1])->id;
        $extensionId = Extension::factory()->create(["id" => 1])->id;
        $author = User::factory()->create(["role_id" => $role->id]);
        $authorId = $author->id;
        $userToken = $author->user_token;
        $doc = Doc::factory()->create([
            'author_id' => $authorId,
            'department_id' => $departmentId,
            'extension_id' => $extensionId
        ]);

        $data = [
            "doc_id" => null,
            'user_token' => $userToken,
        ];

        $response = $this->post('/api/downloads', $data);

        $response->assertStatus(422);
        $response->assertInvalid('doc_id');
    }

    /** @test */
    public function attribute_user_token_is_required_for_storing_download(): void
    {
        $role = Role::factory()->create();
        $departmentId = Department::factory()->create(["id" => 1])->id;
        $extensionId = Extension::factory()->create(["id" => 1])->id;
        $author = User::factory()->create(["role_id" => $role->id]);
        $authorId = $author->id;
        $doc = Doc::factory()->create([
            'author_id' => $authorId,
            'department_id' => $departmentId,
            'extension_id' => $extensionId
        ]);

        $docId = $doc->id;

        $data = [
            "doc_id" => $docId,
            'user_token' => null,
        ];

        $response = $this->post('/api/downloads', $data);

        $response->assertStatus(422);
        $response->assertInvalid('user_token');
    }
}
