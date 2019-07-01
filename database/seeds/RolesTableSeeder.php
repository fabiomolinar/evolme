<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'role_name' => 'Avaliadores',
            'role_description' => 'Usuários que entram no site para avaliar as organizações',
        ]);
    }
}
