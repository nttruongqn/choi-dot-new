<?php

namespace Database\Seeders;

use App\Enums\RoleStatus;
use App\Enums\UserStatus;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'username' => 'nttruongqn',
                'email' => 'nttruongqn@gmail.com',
                'role_id' => RoleStatus::ADMIN,
                'status' => UserStatus::ACTIVE,
                'password' => bcrypt('123456'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'role_id' => RoleStatus::CUSTOMER,
                'status' => UserStatus::ACTIVE,
                'password' => bcrypt('123456'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        \DB::table("users")->insert($data);
    }
}
