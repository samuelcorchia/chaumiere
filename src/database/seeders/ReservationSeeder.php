<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
    $noms = ['Dupont', 'Durand', 'Lefebvre', 'Moreau', 'Petit', 'Rousseau', 'Blanc', 'Guerin'];
    
    for ($i = 0; $i < 20; $i++) {
        $date = now()->addDays(rand(0, 5))->format('Y-m-d');
        $heure = rand(19, 21) . ":" . (rand(0, 1) ? '00' : '30');
        
        \DB::table('reservations')->insert([
            'nom' => $noms[array_rand($noms)] . " " . ($i + 1),
            'reserved_at' => "$date $heure:00",
            'guest_count' => rand(2, 6),
            'phone' => '0601020304',
            'status' => (rand(0, 1) ? 'confirmed' : 'pending'), // Aléatoire entre une reservation confirmée et en attente
            'source' => (rand(0, 1) ? 'web' : 'phone'), // Aléatoire entre une source Web et Telephone
            'tables_id' => rand(1, 5) . "," . rand(6, 10), // Simulation de reservation multitables
            'dateresa' => $date,
            'heure' => $heure,
            'created_at' => now(),
        ]);
    }
}
}
