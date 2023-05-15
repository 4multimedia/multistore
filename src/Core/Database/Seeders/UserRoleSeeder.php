<?php

namespace Multimedia\Multistore\Core\Database\Seeders;

use Illuminate\Database\Seeder;
use Multimedia\Multistore\Core\Models\UserRole;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserRole::create(['name' => ['pl' => 'Gość'], 'area' => ['web' => true, 'backend' => false], 'system' => 1]); // niezalogowany
        UserRole::create(['name' => ['pl' => 'Użytkownik'], 'area' => ['web' => true, 'backend' => false], 'system' => 1]); // zalogowany
        UserRole::create(['name' => ['pl' => 'Administrator'], 'area' => ['web' => true, 'backend' => true], 'system' => 1]); // zalogowany admin
        UserRole::create(['name' => ['pl' => 'Redaktor'], 'area' => ['web' => true, 'backend' => true], 'system' => 1]); // zalogowany,
        UserRole::create(['name' => ['pl' => 'Autor'], 'area' => ['web' => true, 'backend' => true], 'system' => 1]);
    }
}
