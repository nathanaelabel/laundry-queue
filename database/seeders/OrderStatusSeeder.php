<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('order_statuses')->insert([
            [
                'order_status' => 'Antri',
            ],
            [
                'order_status' => 'Sedang Dicuci',
            ],
            [
                'order_status' => 'Setrika',
            ],
            [
                'order_status' => 'Selesai',
            ],
        ]);
    }
}
