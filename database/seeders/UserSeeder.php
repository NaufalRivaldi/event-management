<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@' . config('app.domain'),
            'role_id' => User::USER_ADMIN,
        ]);

        User::factory()->create([
            'name' => 'Anggota',
            'email' => 'anggota@' . config('app.domain'),
            'role_id' => User::USER_ANGGOTA,
        ]);

        for ($i = 0; $i < 50; $i++) {
            User::factory()->create([
                'role_id' => User::USER_ANGGOTA,
            ]);
        }
    }
}
