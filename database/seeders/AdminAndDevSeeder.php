<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminAndDevSeeder extends Seeder
{
    public function run()
    {
        // Data pengguna yang akan dibuat
        $users = [
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'status_user' => 'Admin',
                'user_code' => 'ADM' . rand(0, 999),
                'password' => 'admin123',
            ],
            [
                'name' => 'Developer User',
                'email' => 'developer@example.com',
                'status_user' => 'Developer',
                'user_code' => 'DEV' . rand(0, 999),
                'password' => 'dev12345',
            ],
        ];

        foreach ($users as $data) {
            // Cek apakah pengguna sudah ada berdasarkan email
            $user = User::where('email', $data['email'])->first();

            if (!$user) {
                // Buat pengguna baru
                $user = User::create([
                    'id' => Str::uuid()->toString(),
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password']), // Hash password sesuai input
                    'user_code' => $data['user_code'],
                    'first_name' => $data['name'],
                    'last_name' => $data['name'],
                    'username' => $data['name'],
                    'status_user' => $data['status_user'],
                    'nip' => '',
                    'is_active' => 1,
                    'created_at' => Carbon::now(),
                    'created_by' => null,
                    'updated_at' => Carbon::now(),
                    'updated_by' => null,
                    'deleted_at' => null,
                    'deleted_by' => null,
                ]);

                // Assign role ke pengguna
                $user->assignRole($data['status_user']);
            }
        }
    }
}
