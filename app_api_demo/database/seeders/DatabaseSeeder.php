<?php

namespace Database\Seeders;

use App\Models\CategoryProduct;
use Database\Factories\CategoryFactory;
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
       CategoryProduct::factory(5)->create();

        $this->call([
            UserSeeder::class,
            RoleSeeder::class,
        ]);
    }
}
