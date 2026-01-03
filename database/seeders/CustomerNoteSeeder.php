<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerNoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('customer_notes')->insert([
            [
                'customer_id'    => 1,
                'note'       => 'Customer prefers cash on delivery.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'customer_id'    => 2,
                'note'       => 'VIP customer – give priority support.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
