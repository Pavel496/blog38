<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      User::truncate();

      $user = new User;
      $user->name = 'admin1';
      $user->email = 'admin1@admin1.com';
      $user->password = bcrypt('123123');
      $user->save();

      $user = new User;
      $user->name = 'admin2';
      $user->email = 'admin2@admin2.com';
      $user->password = bcrypt('123123');
      $user->save();
    }
}
