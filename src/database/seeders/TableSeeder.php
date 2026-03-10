<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
        for ($i = 1; $i <= 10; $i++) {
            \DB::table('tables')->insert([
                'id' => $i,
                'name' => "Table $i",
                'capacity' => ($i % 2 == 0) ? 4 : 2, // Tables de 2 ou 4
            ]);
        }
    }
}
