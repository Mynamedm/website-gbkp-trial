<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            RolePermissionSeeder::class,
        ]);

        // Super Admin
        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@gbkp.id',
            'password' => Hash::make('password'),
        ]);
        $superAdmin->assignRole('super_admin');

        // Admin
        $admin = User::create([
            'name' => 'Admin GBKP',
            'email' => 'admin@gbkp.id',
            'password' => Hash::make('password'),
        ]);
        $admin->assignRole('admin');

        // User
        $user = User::create([
            'name' => 'Jemaat',
            'email' => 'user@gbkp.id',
            'password' => Hash::make('password'),
        ]);
        $user->assignRole('user');

        $this->call([
            EventSeeder::class,
            ScheduleSeeder::class,
            AnnouncementSeeder::class,
        ]);
    }
}
