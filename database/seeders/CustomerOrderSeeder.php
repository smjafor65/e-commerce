<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CustomerOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('customer_orders')->insert([
            [
                'customer_id'    => 1,
                'order_number'   => 'ORD-' . Str::upper(Str::random(8)),
                'total_amount'   => 12000.00,
                'status'         => 'delivered',
                'payment_status' => 'paid',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'customer_id'    => 2,
                'order_number'   => 'ORD-' . Str::upper(Str::random(8)),
                'total_amount'   => 12500.00,
                'status'         => 'processing',
                'payment_status' => 'paid',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
        ]);
    }
}
