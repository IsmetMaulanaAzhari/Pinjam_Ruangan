<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Relasi ke tabel rooms
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    // Relasi ke tabel users
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}