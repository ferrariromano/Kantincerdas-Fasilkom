<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tenant;
use Illuminate\Support\Facades\Hash;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Tenant::create([
            'nama_tenant' => 'exampleTenant',
            'password' => Hash::make('password123'),
        ]);
        Tenant::create([
            'nama_tenant' => 'exampleTenant2',
            'password' => Hash::make('password456'),
        ]);
    }
}
