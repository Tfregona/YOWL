<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(20)->create();
        \App\Models\Post::factory(100)->create();
        \App\Models\Comment::factory(500)->create();
        // \App\Models\Subcategory::factory(15)->create();
        // \App\Models\Category::factory(10)->create();

    }
}
