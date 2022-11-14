<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = static::getInsert();
        Schema::disableForeignKeyConstraints();
        DB::table('users')->truncate();
        Schema::enableForeignKeyConstraints();
        DB::table('users')->insert($data);
    }

    private static function getInsert()
    {
        $data = [
            [
                'name'              => 'adminFull',
                'email'             => 'admin@gmail.com',
                'email_verified_at' => now(),
                'password'          => Hash::make('20102000'),
            ]
        ];
        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'name'              => Str::random(10),
                'email'             => Str::random(5) . '@gmail.com',
                'email_verified_at' => now(),
                'password'          => Hash::make('12345678'),
            ];
        }

        return $data;
    }
}
