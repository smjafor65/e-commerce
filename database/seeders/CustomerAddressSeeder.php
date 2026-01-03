<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('customer_addresses')->insert([
            [
                'customer_id' => 1,
                'type'        => 'shipping',
                'country'     => 'Bangladesh',
                'city'        => 'Dhaka',
                'address'     => 'Dhanmondi 32',
                'postal_code' => '1209',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'customer_id' => 2,
                'type'        => 'billing',
                'country'     => 'Bangladesh',
                'city'        => 'Chattogram',
                'address'     => 'Agrabad',
                'postal_code' => '4100',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ]);
    }
}
