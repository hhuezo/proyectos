<?php

use Illuminate\Database\Seeder;
use App\User;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
          'name' => 'jaime',
          'email' => 'jaime@gmail.com',
          'password' => bcrypt('jaime'),
          'admin' => true
        ]);

        User::create([
          'name' => 'juan',
          'email' => 'juan@gmail.com',
          'password' => bcrypt('juan'),
          'admin' => false
        ]);
    }
}
