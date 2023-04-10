<?php

namespace Database\Factories;

use App\Models\Doc;
use App\Models\Download;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Download>
 */
class DownloadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'doc_id' => Doc::inRandomOrder()->first(),
            'user_token' => User::inRandomOrder()->first()->user_token,
            'download_count' => fake()->randomNumber()
        ];
    }
}
