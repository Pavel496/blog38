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

      $adminRole = Role::create(['name' => 'Admin', 'display_name' => 'Администратор']);
      $writerRole = Role::create(['name' => 'Writer', 'display_name' => 'Писатель']);

      $viewPostsPermission = Permission::create([
        'name' => 'View posts', 'display_name' => 'Просмотр публикаций'
      ]);
      $createPostsPermission = Permission::create([
        'name' => 'Create posts', 'display_name' => 'Создание публикаций'
      ]);
      $updatePostsPermission = Permission::create([
        'name' => 'Update posts', 'display_name' => 'Обновление публикаций'
      ]);
      $deletePostsPermission = Permission::create([
        'name' => 'Delete posts', 'display_name' => 'Удаление публикаций'
      ]);

      $viewUsersPermission = Permission::create([
        'name' => 'View users', 'display_name' => 'Просмотр пользователей'
      ]);
      $createUsersPermission = Permission::create([
        'name' => 'Create users', 'display_name' => 'Создание пользователей'
      ]);
      $updateUsersPermission = Permission::create([
        'name' => 'Update users', 'display_name' => 'Обновление пользователей'
      ]);
      $deleteUsersPermission = Permission::create([
        'name' => 'Delete users', 'display_name' => 'Удаление пользователей'
      ]);

      $viewRolesPermission = Permission::create([
        'name' => 'View roles', 'display_name' => 'Просмотр ролей'
      ]);
      $createRolesPermission = Permission::create([
        'name' => 'Create roles', 'display_name' => 'Создание ролей'
      ]);
      $updateRolesPermission = Permission::create([
        'name' => 'Update roles', 'display_name' => 'Обновление ролей'
      ]);
      $deleteRolesPermission = Permission::create([
        'name' => 'Delete roles', 'display_name' => 'Удаление ролей'
      ]);

      $viewPermissionsPermission = Permission::create([
        'name' => 'View permissions', 'display_name' => 'Просмотр разрешений'
      ]);
      // $createPermissionsPermission = Permission::create([
      //   'name' => 'Create permissions', 'display_name' => 'Создание разрешений'
      // ]);
      $updatePermissionsPermission = Permission::create([
        'name' => 'Update permissions', 'display_name' => 'Обновление разрешений'
      ]);
      // $deletePermissionsPermission = Permission::create([
      //   'name' => 'Delete permissions', 'display_name' => 'Удаление разрешений'
      // ]);

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
