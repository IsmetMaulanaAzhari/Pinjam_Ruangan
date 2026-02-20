<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Traits\RoomAvailabilityTrait;

class RentController extends Controller
{
    use RoomAvailabilityTrait;
    
    public function store(Request $request)
    {
        // Validasi input dasar
        $request->validate([
            'nama_ruangan' => 'required',
            'mulai_pinjam' => 'required|date',
            'selesai_pinjam' => 'required|date|after:mulai_pinjam',
            'tujuan' => 'required|string',
        ]);

        // Dapatkan room_id dari nama ruangan
        $room = DB::table('rooms')->where('name', $request->nama_ruangan)->first();
        
        if (!$room) {
            return back()->with('error', 'Ruangan tidak ditemukan.');
        }

        // Gunakan trait untuk cek ketersediaan
        if (!$this->isRoomAvailable($room->id, $request->mulai_pinjam, $request->selesai_pinjam)) {
            return back()->with('error', 'Ruangan sudah dipinjam pada waktu yang sama.');
        }

        // Simpan data jika tidak bentrok
        DB::table('peminjamans')->insert([
            'nama_ruangan'   => $request->nama_ruangan,
            'nama_peminjam'  => Auth::user()->name,
            'mulai_pinjam'   => $request->mulai_pinjam,
            'selesai_pinjam' => $request->selesai_pinjam,
            'tujuan'         => $request->tujuan,
            'status_pinjam'  => 'pending',
            'created_at'     => now(),
        ]);

        return redirect()->back()->with('success', 'Peminjaman berhasil diajukan.');
    }
}