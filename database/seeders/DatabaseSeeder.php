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
        // \App\Models\Category::factory(10)->create();
        // $this->call(SettingDatabaseSeeder::class);
        // $this->call(AdminDatabaseSeeder::class);
        // $this->call(SubCategoryDatabaseSeeder::class);
        // \App\Models\Brand::factory(10)->create();
        \App\Models\Product::factory(10)->create();
    }
}
