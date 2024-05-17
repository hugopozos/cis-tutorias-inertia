<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Admin::create([
            'first_name' => 'Hugo Fabrizio',
            'last_name' => 'Pozos Herrera',
            'phone' => '+522295521144',
            'email' => 'pozos_herrera@outlook.es',
            'email_verified_at' => now(),
            'password' => Hash::make('Contrasena1234'),
            'remember_token' => Str::random(10),
        ]);

        $admin->assignRole('super-admin');
    }
}
