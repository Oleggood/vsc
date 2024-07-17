<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BasisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('basics')->insert([
            ['id' => 1, 'name' => 'УД'],
            ['id' => 2, 'name' => 'межд.запр.'],
            ['id' => 3, 'name' => 'кадры'],
            ['id' => 4, 'name' => 'иное'],
            ['id' => 5, 'name' => 'ПД'],
            ['id' => 6, 'name' => 'ОР'],
            ['id' => 7, 'name' => 'РД'],
            ['id' => 8, 'name' => 'ОДЗ'],
            ['id' => 9, 'name' => 'ПОП'],
            ['id' => 10, 'name' => 'СБ'],
            ['id' => 11, 'name' => 'ОД'],
        ]);
    }
}
