<?php

namespace Tests\Feature\Api;

use App\Models\Department;
use App\Models\Doc;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Testing\File;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class DocTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');
        $this->withHeaders([
            'accept' => 'application/json'
        ]);
    }

    /** @test */
    public function doc_can_be_stored(): void
    {
        $this->withoutExceptionHandling();
        $role = Role::factory()->create();
        $authorId = User::factory()->create(["role_id" => $role->id])->id;
        $departmentId = Department::factory()->create()->id;
        $file = File::create('doc.pdf');

        $data = [
            "title" => "title 4",
            'author_id' => $authorId,
            "file" => $file,
            'department_id' => $departmentId,
            "is_published" => 1,
            'published_date' => "2023-01-02",
        ];

        $response = $this->post('/api/docs', $data);
        $this->assertDatabaseCount('docs', 1);
        $doc = Doc::first();

        $this->assertEquals($data["title"], $doc->title);
        $this->assertEquals($data["author_id"], $doc->author_id);
        $this->assertEquals($data["department_id"], $doc->department_id);
        $this->assertEquals($data["is_published"], $doc->is_published);
        $this->assertEquals("docs/" . $file->hashName(), $doc->file);
        $this->assertEquals($data["published_date"], $doc->published_date);

        Storage::disk('public')->assertExists($doc->file);
    }

    /** @test */
    public function attribute_title_is_required_for_storing_doc(): void
    {
        $role = Role::factory()->create();
        $authorId = User::factory()->create(["role_id" => $role->id])->id;
        $departmentId = Department::factory()->create()->id;

        Storage::fake('public');

        $file = File::create('doc.pdf');

        $data = [
            "title" => "",
            'author_id' => $authorId,
            'department_id' => $departmentId,
            "is_published" => 1,
            'file' => $file,
            'published_date' => "2023-01-02",
        ];

        $response = $this->post('/api/docs', $data);

        $response->assertStatus(422);
        $response->assertInvalid('title');
    }

    /** @test */
    public function attribute_author_id_is_required_for_storing_doc(): void
    {
        $departmentId = Department::factory()->create()->id;

        Storage::fake('public');

        $file = File::create('doc.pdf');

        $data = [
            "title" => "title",
            'author_id' => null,
            'department_id' => $departmentId,
            "is_published" => 1,
            'file' => $file,
            'published_date' => "2023-01-02",
        ];

        $response = $this->post('/api/docs', $data);

        $response->assertStatus(422);
        $response->assertInvalid('author_id');
    }

    /** @test */
    public function attribute_department_id_is_required_for_storing_doc(): void
    {
        $role = Role::factory()->create();
        $authorId = User::factory()->create(["role_id" => $role->id])->id;

        Storage::fake('public');

        $file = File::create('doc.pdf');

        $data = [
            "title" => "title",
            'author_id' => $authorId,
            'department_id' => null,
            "is_published" => 1,
            'file' => $file,
            'published_date' => "2023-01-02",
        ];

        $response = $this->post('/api/docs', $data);

        $response->assertStatus(422);
        $response->assertInvalid('department_id');
    }

    /** @test */
    public function attribute_file_for_storing_post(): void
    {
        $role = Role::factory()->create();
        $authorId = User::factory()->create(["role_id" => $role->id])->id;
        $departmentId = Department::factory()->create()->id;

        $data = [
            "title" => "title",
            'author_id' => $authorId,
            'department_id' => $departmentId,
            "is_published" => 1,
            'file' => null,
            'published_date' => "2023-01-02",
        ];

        $response = $this->post('/api/docs', $data);

        $response->assertStatus(422);
        $response->assertInvalid('file');
    }
}
