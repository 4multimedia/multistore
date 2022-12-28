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
        UserRole::create(['name' => ['pl' => 'Gość'], 'area' => ['web' => true, 'backend' => false]]); // niezalogowany
        UserRole::create(['name' => ['pl' => 'Użytkownik'], 'area' => ['web' => true, 'backend' => false]]); // zalogowany
        UserRole::create(['name' => ['pl' => 'Administrator'], 'area' => ['web' => true, 'backend' => true]]); // zalogowany admin
        UserRole::create(['name' => ['pl' => 'Redaktor'], 'area' => ['web' => true, 'backend' => true]]); // zalogowany,
        UserRole::create(['name' => ['pl' => 'Autor'], 'area' => ['web' => true, 'backend' => true]]);
    }
}
