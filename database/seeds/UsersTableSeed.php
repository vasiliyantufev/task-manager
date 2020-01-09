<?php

use Illuminate\Database\Seeder;

class UsersTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Pety',
            'first_name' => 'Pety',
            'middle_name' => 'Petrovich',
            'last_name' => 'Petrov',
            'sex' => 1,
            'birthday' => '1979-01-14',
            'password' => bcrypt('11111111'),
            'email' => 'pety@gmail.com',
            'is_admin' => 1,
        ]);
    }
}
