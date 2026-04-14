<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // IT Support
        User::create([
            'name' => 'IT Support',
            'email' => 'itsupport@helpdesk.com',
            'password' => Hash::make('password'),
            'role' => 'it_support',
        ]);

        // Employee
        User::create([
            'name' => 'Employee Demo',
            'email' => 'employee@helpdesk.com',
            'password' => Hash::make('password'),
            'role' => 'employee',
        ]);
    }
}