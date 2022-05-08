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
            'role_id' => 1,
        ]);

        User::factory()->create([
            'name' => 'Anggota',
            'email' => 'anggota@' . config('app.domain'),
            'role_id' => 2,
        ]);
    }
}
