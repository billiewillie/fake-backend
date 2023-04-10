<?php

    namespace Database\Factories;

    use App\Models\Channel;
    use Illuminate\Database\Eloquent\Factories\Factory;

    /**
     * @extends Factory<Channel>
     */
    class ChannelFactory extends Factory
    {
        /**
         * Define the model's default state.
         *
         * @return array<string, mixed>
         */
        public function definition(): array
        {
            return [
                'title' => $this->faker->words(1, true)
            ];
        }
    }
