<?php

namespace App\Traits;

use App\Models\Rent;
use Carbon\Carbon;

trait RoomAvailabilityTrait 
{
    /**
     * Fungsi untuk mengecek apakah ruangan tersedia pada waktu yang diminta
     * @param int $room_id ID ruangan yang ingin dipinjam
     * @param string $start_time Waktu mulai peminjaman
     * @param string $end_time Waktu selesai peminjaman
     * @param int|null $exclude_id ID peminjaman yang akan dikecualikan dari pengecekan (untuk update)
     * @return bool True jika tersedia, False jika bentrok
     */
    public function isRoomAvailable($room_id, $start_time, $end_time, $exclude_id = null)
    {
        // Pastikan format waktu konsisten
        $start = Carbon::parse($start_time);
        $end = Carbon::parse($end_time);
        
        $query = Rent::where('room_id', $room_id)
            ->where(function ($query) use ($start, $end) {
                // Cek semua kemungkinan overlap waktu
                // Case 1: Waktu mulai baru berada di antara rentang waktu yang sudah ada
                $query->where(function($q) use ($start) {
                    $q->where('time_start_use', '<=', $start)
                      ->where('time_end_use', '>', $start);
                })
                // Case 2: Waktu akhir baru berada di antara rentang waktu yang sudah ada
                ->orWhere(function($q) use ($end) {
                    $q->where('time_start_use', '<', $end)
                      ->where('time_end_use', '>=', $end);
                })
                // Case 3: Rentang waktu baru sepenuhnya di dalam rentang waktu yang sudah ada
                ->orWhere(function($q) use ($start, $end) {
                    $q->where('time_start_use', '>=', $start)
                      ->where('time_end_use', '<=', $end);
                })
                // Case 4: Rentang waktu baru melingkupi sepenuhnya rentang waktu yang sudah ada
                ->orWhere(function($q) use ($start, $end) {
                    $q->where('time_start_use', '<=', $start)
                      ->where('time_end_use', '>=', $end);
                });
            })
            ->whereIn('status', ['pending', 'dipinjam']); // Hanya cek yang pending atau sedang dipinjam
        
        // Jika sedang update peminjaman, kecualikan ID peminjaman saat ini
        if ($exclude_id) {
            $query->where('id', '!=', $exclude_id);
        }
        
        // Untuk debugging
        // dd($query->toSql(), $query->getBindings(), $query->exists());
        
        return !$query->exists(); // Return true jika tidak ada bentrok
    }
    
    /**
     * Metode debugging untuk melihat peminjaman yang overlap
     */
    public function getOverlappingBookings($room_id, $start_time, $end_time)
    {
        $start = Carbon::parse($start_time);
        $end = Carbon::parse($end_time);
        
        return Rent::where('room_id', $room_id)
            ->where(function ($query) use ($start, $end) {
                $query->where(function($q) use ($start) {
                    $q->where('time_start_use', '<=', $start)
                      ->where('time_end_use', '>', $start);
                })
                ->orWhere(function($q) use ($end) {
                    $q->where('time_start_use', '<', $end)
                      ->where('time_end_use', '>=', $end);
                })
                ->orWhere(function($q) use ($start, $end) {
                    $q->where('time_start_use', '>=', $start)
                      ->where('time_end_use', '<=', $end);
                })
                ->orWhere(function($q) use ($start, $end) {
                    $q->where('time_start_use', '<=', $start)
                      ->where('time_end_use', '>=', $end);
                });
            })
            ->whereIn('status', ['pending', 'dipinjam'])
            ->get();
    }
}