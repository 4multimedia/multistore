<?php

namespace Multimedia\Multistore\Core\Database\Seeders;

use Illuminate\Database\Seeder;
use Multimedia\Multistore\Core\Models\UserStatus;

class UserStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserStatus::create(['name' => 'Nieaktywny', 'login' => 0]);
        UserStatus::create(['name' => 'Aktywny', 'login' => 1]);
        UserStatus::create(['name' => 'Zablokowany', 'login' => 0]);
        UserStatus::create(['name' => 'Ukryty', 'login' => 0]);
    }
}
