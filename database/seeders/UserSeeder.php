<?php

namespace Database\Seeders;

use App\Constants\Roles;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $namedUsers = [
            ['name' => 'System Admin', 'email' => 'sysadmin@gmail.com', 'role' => Roles::SYSTEM_ADMIN],
            ['name' => 'Super Admin',  'email' => 'superadmin@gmail.com', 'role' => Roles::SUPER_ADMIN],
            ['name' => 'Admin',        'email' => 'admin@gmail.com',      'role' => Roles::ADMIN],
            ['name' => 'Test User',    'email' => 'test@example.com',     'role' => null],
        ];

        foreach ($namedUsers as $userData) {
            $role = $userData['role'];
            unset($userData['role']);

            $user = User::factory()->create($userData);
            if ($role) {
                $user->assignRole($role);
            }
        }

        // Optional: create 10 random users
        User::factory(10)->create();
    }
}
