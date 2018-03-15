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
      $user->name = 'admin';
      $user->email = 'admin@admin.com';
      $user->password = bcrypt('123123');
      $user->save();
    }
}
