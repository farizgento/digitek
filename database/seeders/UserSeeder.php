<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
                // SEKOLAH 1
                $super_admin_role = Role::create(['name' => 'super_admin']);
                $super_admin = User::create([
                    'name' => 'super admin',
                    'email' => 'superadmin@gmail.com',
                    'password' => bcrypt('password'),
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
