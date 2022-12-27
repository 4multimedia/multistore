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
        UserRole::create(['name' => 'Gość', 'area' => ['web' => true, 'backend' => false]]); // niezalogowany
        UserRole::create(['name' => 'Użytkownik', 'area' => ['web' => true, 'backend' => false]]); // zalogowany
        UserRole::create(['name' => 'Administrator', 'area' => ['web' => true, 'backend' => true]]); // zalogowany admin
        UserRole::create(['name' => 'Redaktor', 'area' => ['web' => true, 'backend' => true]]); // zalogowany,
        UserRole::create(['name' => 'Autor', 'area' => ['web' => true, 'backend' => true]]);
    }
}
