<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShoppingSessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 11; $i++) {
            DB::table('shopping_session')->insert(
                [
                    'user_id' => $i,
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            );
        }
    }
}
