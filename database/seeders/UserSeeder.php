<?php

namespace Database\Seeders;

use App\Models\User;
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
        $users = array(
            [
                'name' => 'Admin JTI',
                'email' => 'admin@jti.com',
                'password' => bcrypt('password'),
                'is_admin' => '1',
            ],
            [
                'name' => 'User JTI',
                'email' => 'user@jti.com',
                'password' => bcrypt('password'),
                'is_admin' => null,
            ]
        );

        array_map(function (array $user) {
            User::query()->updateOrCreate(
                ['email' => $user['email']],
                $user
            );
        }, $users);
    }
}
