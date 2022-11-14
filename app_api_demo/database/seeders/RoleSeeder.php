<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RoleSeeder extends Seeder
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
        DB::table('roles')->truncate();
        DB::table('permissions')->truncate();
        DB::table('role_permission')->truncate();
        Schema::enableForeignKeyConstraints();
        DB::table('roles')->insert($data['role']);
        DB::table('permissions')->insert($data['permission']);
        DB::table('role_permission')->insert($data['role_permission']);
    }

    private static function getInsert()
    {
        $roles = [
            ['name' => 'product_management'],
            ['name' => 'blog_management'],
            ['name' => 'user_management'],
        ];

        $permission_detail = [
            //permission_product
            '0' => [
                ['name' => 'view_product'],
                ['name' => 'create_product'],
                ['name' => 'edit_product'],
                ['name' => 'update_product'],
                ['name' => 'delete_product'],
            ],
            //permission_blog
            '1' => [
                ['name' => 'view_blog'],
                ['name' => 'create_blog'],
                ['name' => 'edit_blog'],
                ['name' => 'update_blog'],
                ['name' => 'delete_blog'],
            ],
            //permission_user
            '2' => [
                ['name' => 'view_user'],
                ['name' => 'create_user'],
                ['name' => 'edit_user'],
                ['name' => 'update_user'],
                ['name' => 'delete_user'],
            ]
        ];

        $role_permission = [];
        $permissions = [];
        $permission_length = 1;

        foreach ($permission_detail as $key_parent => $permission) {
            foreach ($permission as $per) {
                $role_permission[] = ['permission_id' => $permission_length, 'role_id' => $key_parent + 1];
                $permissions[] = $per;
                $permission_length++;
            }
        }
        return [
            'role' => $roles,
            'permission' => $permissions,
            'role_permission' => $role_permission,
        ];
    }
}
