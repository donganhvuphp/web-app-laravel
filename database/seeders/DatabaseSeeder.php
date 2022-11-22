<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\CategoryProduct;
use App\Models\Product;
use App\Models\ShoppingSession;
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
       Brand::factory(10)->create();
       Product::factory(10)->create();

        $this->call([
            UserSeeder::class,
            RoleSeeder::class,
            ShoppingSessionSeeder::class,
        ]);
    }
}
