<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Role::create([
            'name' => 'Super Admin',
            'slug' => 'superadmin',
            'description' => 'Role for super admin',
            'guard_name' => 'web',
            'permissions' =>json_encode([]),
            'created_by' => 1,
            'updated_by' => 1,

        ]);
        \App\Models\Role::create([
            'name' => 'Admin',
            'slug' => 'admin',
            'description' => 'Role for admin',
            'guard_name' => 'web',
            'permissions' =>json_encode([]),
            'created_by' => 1,
            'updated_by' => 1,

        ]);
        \App\Models\Role::create([
            'name' => 'User',
            'slug' => 'user',
            'description' => 'Role for admin',
            'guard_name' => 'web',
            'permissions' =>json_encode(
                [
                    "home"=>true,
                    "user.userProfile"=>true,
                    "user.saveProfile"=>true,
                    "user.saveNewPassword"=>true,
                    "user.changePassword"=>true,
                    "user.getStates"=>true,
                    "user.getCities"=>true
                ]
            ),
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        \App\Models\Role::create([
            'name' => 'Marketer',
            'slug' => 'marketer',
            'description' => 'Role for Marketer',
            'guard_name' => 'web',
            'permissions' =>json_encode([]),
            'created_by' => 1,
            'updated_by' => 1,

        ]);

        \App\Models\Role::create([
            'name' => 'Moderator',
            'slug' => 'moderator',
            'description' => 'Role for Moderator',
            'guard_name' => 'web',
            'permissions' =>json_encode([]),
            'created_by' => 1,
            'updated_by' => 1,

        ]);

        $user = \App\Models\User::find(2);
        $user->roles()->attach(2);
        $user = \App\Models\User::find(3);
        $user->roles()->attach(3);

//        $user = \App\Models\User::find(4);
//        $user->roles()->attach(3);
//        $user = \App\Models\User::find(5);
//        $user->roles()->attach(3);
//        $user = \App\Models\User::find(6);
//        $user->roles()->attach(3);
    }
}
