<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Employer;

class EmployerSeeder extends Seeder
{
    public function run(): void
    {
        Employer::create([
                'name' => 'Employer',
                'email' => "employer@example.com",
                'image_path' => '', // or use fake()->imageUrl() 
                'password' => Hash::make('password'),
                'remember_token' => Str::random(60),
                'phone' => fake()->phoneNumber(),

        ]);

        for ($i = 1; $i <= 19; $i++) {
            $fakeCompany = fake()->company();
            $prefix = strtolower(strtok($fakeCompany, ' '));
            $prefix = preg_replace('/[^a-z0-9]/', '', $prefix); // keep only alphanumeric
            $fakeEamil = $prefix.$i.'@gmail.com';
            Employer::create([
                'name' => $fakeCompany,
                'email' => $fakeEamil,
                'image_path' => '', // or use fake()->imageUrl()
                'password' => Hash::make('password'),
                'remember_token' => Str::random(60),
                'phone' => fake()->phoneNumber(),
            ]);
        }
    }
}
