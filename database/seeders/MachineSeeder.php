<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class MachineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('machines')->insert([
            [
                'name' => 'Panasonic',
                'status' => 'Available',
            ],
            [
                'name' => 'Samsung',
                'status' => 'Available',
            ],
            [
                'name' => 'LG',
                'status' => 'Available',
            ],
            [
                'name' => 'Sony',
                'status' => 'Available',
            ],
        ]);
    }
}
