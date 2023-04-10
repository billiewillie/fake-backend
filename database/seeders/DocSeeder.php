<?php

namespace Database\Seeders;

use App\Models\Doc;
use Illuminate\Database\Seeder;

class DocSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Doc::factory(20)->create();
    }
}
