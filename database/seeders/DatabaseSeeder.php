<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        // SEKOLAH 1
        $super_admin_role = Role::create(['name' => 'super_admin']);
        $super_admin = User::create([
            'name' => 'super admin',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('password'),
            'sekolah_id' => 1,
        ]);
        $super_admin -> assignRole($super_admin_role);

        $admin_role = Role::create(['name' => 'admin']);
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'sekolah_id' => 1,
        ]);
        $admin -> assignRole($admin_role);

        $user_role = Role::create(['name' => 'user']);
        $user = User::create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => bcrypt('password'),
            'sekolah_id' => 1,
        ]);
        $user -> assignRole($user_role);

        // SEKOLAH 2

        $super_admin = User::create([
            'name' => 'super admin 2',
            'email' => 'superadmin2@gmail.com',
            'password' => bcrypt('password'),
            'sekolah_id' => 2,
        ]);
        $super_admin -> assignRole($super_admin_role);

        $admin = User::create([
            'name' => 'admin 2',
            'email' => 'admin2@gmail.com',
            'password' => bcrypt('password'),
            'sekolah_id' => 2,
        ]);
        $admin -> assignRole($admin_role);

        $user = User::create([
            'name' => 'user 2',
            'email' => 'user2@gmail.com',
            'password' => bcrypt('password'),
            'sekolah_id' => 2,
        ]);
        $user -> assignRole($user_role);


        // SEKOLAH 3 
        $super_admin = User::create([
            'name' => 'super admin 3',
            'email' => 'superadmin3@gmail.com',
            'password' => bcrypt('password'),
            'sekolah_id' => 3,
        ]);
        $super_admin -> assignRole($super_admin_role);

        $admin = User::create([
            'name' => 'admin 3',
            'email' => 'admin3@gmail.com',
            'password' => bcrypt('password'),
            'sekolah_id' => 3,
        ]);
        $admin -> assignRole($admin_role);

        $user = User::create([
            'name' => 'user 3',
            'email' => 'user3@gmail.com',
            'password' => bcrypt('password'),
            'sekolah_id' => 3,
        ]);
        $user -> assignRole($user_role);
    }
    
}
