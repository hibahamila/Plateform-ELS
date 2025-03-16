<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\PermissionsDemoSeeder;
use Illuminate\Database\Seeder;
use UserSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(PermissionsDemoSeeder::class);

    }
}
