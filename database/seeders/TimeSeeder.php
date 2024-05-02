<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class TimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('times')->insert([
            [
                'type' => 'Tipe A',
                'duration' => '06:00:00',
            ],
            [
                'type' => 'Tipe B',
                'duration' => '08:00:00',
            ],
            [
                'type' => 'Tipe C',
                'duration' => '10:00:00',
            ],
        ]);
    }
}
