<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void

    {
          DB::table('customer_profiles')->insert([
            [
                'customer_name'   => "Abdullah",
                'photos'=>"1234.jpg",
                'email'        => 'j@gmail.com',
                'gender'        => 'male',
                'date_of_birth' => '1998-05-10',
                'phone'=>'01756415645',
                'password' => '12345678',
                'total_orders'  => 3,
                'total_spent'   => 24500.00,
                'customer_type' => 'returning',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'customer_nane'   => "Zayma Rahman",
                 'photos'=>"12345.jpg",
                'email'        => 'z@gmail.com',
                'gender'        => 'female',
                'date_of_birth' => '2000-01-15',
                'phone'=>'01756415648',
                'password' => '12345687',
                'total_orders'  => 1,
                'total_spent'   => 7500.00,
                'customer_type' => 'new',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
        ]);
    }
}
