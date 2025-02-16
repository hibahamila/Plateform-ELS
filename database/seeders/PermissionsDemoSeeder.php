<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
class PermissionsDemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //creer les permissions
        $permission1= Permission::create(['name'=>'gerer les permissions des admins']);
        $permission2= Permission::create(['name'=>'gerer des permission']);
        $permission3= Permission::create(['name'=>'gerer des roles']);
        //creer les roles + leur donner des permissions
        $superAdmin= Role::create(['name'=>'super-admin']);
        $admin = Role::create(['name'=>'admin'])->givePermissionTo($permission2,$permission3);
        $professeur= Role::create(['name'=>'professeur']);
        $etudiant= Role::create(['name'=>'etudiant']);
        \App\Models\User::factory()->create([
            'name' => 'oumayma',
            'last_name' => 'zahrouni',
            'email' => 'superAdmin@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('superAdmin123')
        ])->assignRole($superAdmin);
        \App\Models\User::factory()->create([
            'name' => 'hiba',
            'last_name' => 'hamila',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('admin123')
        ])->assignRole($admin);
    }
}
