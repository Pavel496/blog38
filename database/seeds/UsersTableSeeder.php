<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Permission::truncate();
      Role::truncate();
      User::truncate();

      $adminRole = Role::create(['name' => 'Admin']);
      $writerRole = Role::create(['name' => 'Writer']);

      $viewPostsPermission = Permission::create(['name' => 'View posts']);
      $createPostsPermission = Permission::create(['name' => 'Create posts']);
      $updatePostsPermission = Permission::create(['name' => 'Update posts']);
      $deletePostsPermission = Permission::create(['name' => 'Delete posts']);

      $viewUsersPermission = Permission::create(['name' => 'View users']);
      $createUsersPermission = Permission::create(['name' => 'Create users']);
      $updateUsersPermission = Permission::create(['name' => 'Update users']);
      $deleteUsersPermission = Permission::create(['name' => 'Delete users']);

      $viewRolesPermission = Permission::create(['name' => 'View roles']);
      $createRolesPermission = Permission::create(['name' => 'Create roles']);
      $updateRolesPermission = Permission::create(['name' => 'Update roles']);
      $deleteRolesPermission = Permission::create(['name' => 'Delete roles']);

      $admin = new User;
      $admin->name = 'admin1';
      $admin->email = 'admin1@admin1.com';
      $admin->password = '123123';
      $admin->save();

      $admin->assignRole($adminRole);

      $writer = new User;
      $writer->name = 'admin2';
      $writer->email = 'admin2@admin2.com';
      $writer->password = '123123';
      $writer->save();

      $writer->assignRole($writerRole);
    }
}
