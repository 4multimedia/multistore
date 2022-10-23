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
        UserStatus::create(['name' => 'Nieaktywny']);
        UserStatus::create(['name' => 'Aktywny']);
        UserStatus::create(['name' => 'Zablokowany']);
        UserStatus::create(['name' => 'Ukryty']);
    }
}
