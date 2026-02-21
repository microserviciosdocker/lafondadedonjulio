<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Super Admin',
                'email' => 'admin@lafondadedonjulio.com',
                'password' => Hash::make('admin123'),
                'is_active' => true,
                'is_trusted_client' => false,
            ],
            [
                'name' => 'Doña María',
                'email' => 'maria@lafondadedonjulio.com',
                'password' => Hash::make('maria123'),
                'is_active' => true,
                'is_trusted_client' => false,
            ],
            [
                'name' => 'Juan Pérez',
                'email' => 'juan@cliente.com',
                'phone' => '+50370123456',
                'password' => Hash::make('cliente123'),
                'is_active' => true,
                'is_trusted_client' => true,
            ],
        ];

        foreach ($users as $userData) {
            $user = User::firstOrCreate(
                ['email' => $userData['email']],
                $userData
            );

            if ($user->email === 'admin@lafondadedonjulio.com') {
                $user->assignRole('super_admin');
            } elseif ($user->email === 'maria@lafondadedonjulio.com') {
                $user->assignRole('admin');
            } else {
                $user->assignRole('cliente');
            }
        }

        $this->command->info('Usuarios creados con roles asignados');
    }
}
