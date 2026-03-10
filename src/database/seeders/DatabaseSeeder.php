<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Table;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void {
        $this->call([
            TableSeeder::class,
            QuotaSeeder::class,
            ReservationSeeder::class,
        ]);
        /*
        User::factory()->create([
            'name' => 'Aurelien MONTI',
            'email' => 'samuel.corchia@gmail.com',
            'is_admin' => true,
            'password' => bcrypt('Br6dd534') 
        ]);
        Table::factory()->count(20)->create();
        */
    }
}
