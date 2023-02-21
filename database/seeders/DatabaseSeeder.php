<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Member;
use App\Models\Outlet;
use App\Models\Paket;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
        Outlet::factory(10)->create();
        User::factory(20)->create();
        Paket::factory(25)->create();
        Member::factory(15)->create();
        DB::table('users')->insert([
            'name' => 'Marcel Dwi Astika',
            'username' => 'mdwiastika',
            'email' => 'marceldwias@gmail.com',
            'role' => 'admin',
            'id_outlet' => 1,
            'email_verified_at' => now(),
            'password' => Hash::make('takganti123'), // password
        ]);
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
