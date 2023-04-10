<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\Doc;
use App\Models\Extension;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Doc>
 */
class DocFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $createdAt = fake()->dateTimeThisYear();
        $publishedDate = fake()->dateTimeInInterval('-11 months', '+10 months');
        $unpublishedDate = rand(1, 3) < 2 ? $publishedDate : null;

        return [
            'title' => fake()->words(mt_rand(1, 2), true),
            'author_id' => User::inRandomOrder()->first(),
            'department_id' => Department::inRandomOrder()->first(),
            'is_published' => fake()->boolean(),
            'file' => fake()->imageUrl(630, 470, null, true, null, false, 'jpg'),
            'extension_id' => Extension::inRandomOrder()->first(),
            'download_count' => fake()->randomNumber(),
            'published_date' => $publishedDate,
            'unpublished_date' => $unpublishedDate,
            'created_at' => $createdAt,
            'updated_at' => $createdAt,
        ];
    }
}
