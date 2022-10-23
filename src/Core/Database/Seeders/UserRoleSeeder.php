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
        UserRole::create(['name' => 'Gość', 'area' => ['web']]); // niezalogowany
        UserRole::create(['name' => 'Użytkownik', 'area' => ['web']]); // zalogowany
        UserRole::create(['name' => 'Administrator', 'area' => ['web', 'backend']]); // zalogowany admin
        UserRole::create(['name' => 'Redaktor', 'area' => ['web', 'backend']]); // zalogowany,
        UserRole::create(['name' => 'Autor', 'area' => ['web', 'backend']]);
    }
}
