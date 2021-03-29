<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'admin',
            'display_name' => 'Администратор',
            'description' => 'Администратор',     
        ]);

        DB::table('roles')->insert([
            'name' => 'user',
            'display_name' => 'Пользователь',
            'description' => 'Пользователь',     
        ]);
        DB::table('roles')->insert([
            'name' => 'manager',
            'display_name' => 'Менеджер',
            'description' => 'Менеджер',     
        ]);
    }
}
