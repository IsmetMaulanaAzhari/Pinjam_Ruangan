<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Relasi ke tabel buildings
    public function building()
    {
        return $this->belongsTo(Building::class);
    }

    // Relasi ke tabel rents
    public function rentals()
    {
        return $this->hasMany(Rent::class, 'room_id');
    }

    // Override route key untuk menggunakan 'code' sebagai parameter
    public function getRouteKeyName()
    {
        return 'code';
    }
}