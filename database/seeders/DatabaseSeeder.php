<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Base\Database\Seeders\BaseDatabaseSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call(RolePermissionSeeder::class);
        $this->call(BaseDatabaseSeeder::class);
    }
}
