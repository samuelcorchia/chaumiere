<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $table = 'reservations';
    protected $fillable = [
        'nom', 
        'reserved_at', 
        'guest_count', 
        'phone', 
        'mail', 
        'remarque', 
        'tables_id', 
        'status', 
        'source', 
        'dateresa', 
        'heure'
];

    use HasFactory;
}
