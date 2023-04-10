<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            PostSeeder::class,
            ChannelSeeder::class,
            GallerySeeder::class,
            LikeSeeder::class,
            ViewSeeder::class,
            CommentSeeder::class,
            ChannelPostSeeder::class,
            DepartmentSeeder::class,
            ExtensionSeeder::class,
            DocSeeder::class,
            DownloadSeeder::class,
        ]);
    }
}
