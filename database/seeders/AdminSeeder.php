<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{   
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Owner Account -------
        Admin::create([
            'name' => 'Owner',
            'email' => 'owner@gmail.com',
            'password' => Hash::make('123456'),
        ])->assignRole('Owner');
        // ---------------------

        Admin::factory()->count(100)->create();
    }
}
