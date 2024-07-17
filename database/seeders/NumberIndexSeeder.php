<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NumberIndexSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('number_indexes')->insert([
            ['id' => 1, 'name' => '01'],
            ['id' => 2, 'name' => '02'],
            ['id' => 3, 'name' => '03'],
            ['id' => 4, 'name' => '04'],
            ['id' => 5, 'name' => '05'],
        ]);
    }
}
