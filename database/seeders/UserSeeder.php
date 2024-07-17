<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'one',
            'email' => 'one',
            'password' => Hash::make('1q2w3e4r5'),
            'note' => 'удалите данного пользователя после создания первого администратора',
            'role_id' => 1,
        ]);
    }
}
