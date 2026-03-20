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
            ['name' => 'System Admin', 'email' => 'sysadmin@example.com', 'role' => Roles::SYSTEM_ADMIN],
            ['name' => 'Super Admin',  'email' => 'superadmin@example.com', 'role' => Roles::SUPER_ADMIN],
            ['name' => 'Admin',        'email' => 'admin@example.com',      'role' => Roles::ADMIN],
        ];

        foreach ($namedUsers as $userData) {
            $role = $userData['role'];
            unset($userData['role']);

            $user = User::factory()->create($userData);
            if ($role) {
                $user->assignRole($role);
            }
        }

    }
}
