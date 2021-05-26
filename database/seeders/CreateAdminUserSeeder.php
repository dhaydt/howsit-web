<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Administrator',
            'email' => 'adminstrator@howsit.com',
            'password' => bcrypt('adminadmin'),
            'profile_image' => 'profile.png',
            'phone' => '082382852283'
        ]);

        $role = Role::create(['name' => 'Admin']);

        $permissions = Permission::pluck('id', 'id') -> all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
    }
}
