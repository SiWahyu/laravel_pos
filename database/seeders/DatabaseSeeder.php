<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Schema::disableForeignKeyConstraints();

        DB::table('users')->truncate();
        DB::table('roles')->truncate();
        DB::table('customers')->truncate();

        $roles = [
            ['name' => 'Admin'],
            ['name' => 'Customer'],
            ['name' => 'Kasir'],
            ['name' => 'Gudang'],
            ['name' => 'Barang'],
        ];

        foreach ($roles as $role) {
            Role::create(
                $role
            );
        }

        $user = User::create([
            'username' => 'SI Wahyu',
            'email' => 'siwahyu@gmail.com',
            'password' => Hash::make('siwahyu'),
        ]);

        $user->syncRoles('admin');

        Schema::enableForeignKeyConstraints();
    }
}
