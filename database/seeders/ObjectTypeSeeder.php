<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ObjectTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('object_types')->insert([
            ['id' => 1, 'name' => 'физ.лицо'],
            ['id' => 2, 'name' => 'юр.лицо'],
            ['id' => 3, 'name' => 'адрес'],
            ['id' => 4, 'name' => 'иное'],
        ]);
    }
}
