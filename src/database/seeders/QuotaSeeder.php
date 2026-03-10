<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
        \DB::table('quotas')->insert([
            'nb' => 5, // Capacité totale du resto
            'updated_at' => now(),
        ]);
    }
}
