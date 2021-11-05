<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'name' => 'Super Admin',
            'email' => 'admin@admin.com.br',
            'password' => Hash::make('admin@1234')
        ];

        $user = User::updateOrCreate([
            'email' => $data['email']
        ], $data);
    }
}
